<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use App\Services\AgendaCerdasService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CalendarEventController extends Controller
{
    public function index(Request $request, AgendaCerdasService $service)
    {
        $selectedCalendars = collect($service->integration()->selected_calendars ?? [])->filter()->values();
        $search = trim((string) $request->query('search', ''));

        $events = collect();

        if ($selectedCalendars->isNotEmpty()) {
            foreach ($selectedCalendars as $calendarName) {
                try {
                    $payload = $service->agenda($calendarName);
                    $events = $events->merge($this->extractEvents($payload));
                } catch (\Throwable $e) {
                    continue;
                }
            }
        }

        $rows = $events
            ->map(fn (array $event) => $this->mapAgendaEventToRow($event))
            ->filter(function (object $item) use ($search) {
                if ($search === '') {
                    return true;
                }

                $haystack = mb_strtolower(implode(' ', [
                    (string) ($item->title ?? ''),
                    (string) ($item->description ?? ''),
                    (string) ($item->location ?? ''),
                ]));

                return str_contains($haystack, mb_strtolower($search));
            })
            ->sortByDesc(fn (object $item) => $item->start_at?->timestamp ?? 0)
            ->values();

        $items = $this->paginateCollection($rows, 12, $request);

        return view('admin.calendar.index', compact('items'));
    }

    private function extractEvents(array $payload): array
    {
        if (isset($payload['data']['events']) && is_array($payload['data']['events'])) {
            return $payload['data']['events'];
        }

        if (isset($payload['events']) && is_array($payload['events'])) {
            return $payload['events'];
        }

        if (isset($payload['data']) && is_array($payload['data']) && array_is_list($payload['data'])) {
            return $payload['data'];
        }

        if (array_is_list($payload)) {
            return $payload;
        }

        return [];
    }

    private function mapAgendaEventToRow(array $event): object
    {
        $title = (string) ($event['title'] ?? $event['subject'] ?? 'Tanpa Judul');
        $description = (string) ($event['notes'] ?? $event['description'] ?? '');
        $date = $event['date'] ?? null;
        $startRaw = $event['startTime'] ?? $event['start_at'] ?? $event['start'] ?? $date;

        if (is_string($startRaw) && preg_match('/^\d{1,2}:\d{2}/', $startRaw) && is_string($date)) {
            $startRaw = $date . ' ' . $startRaw;
        }

        $startAt = null;
        if (!empty($startRaw)) {
            try {
                $startAt = Carbon::parse($startRaw);
            } catch (\Throwable $e) {
                $startAt = null;
            }
        }

        $location = (string) (
            $event['location']
            ?? data_get($event, 'room.name')
            ?? data_get($event, 'room')
            ?? '-'
        );

        $participants = (int) ($event['participants'] ?? $event['participantCount'] ?? 0);
        $capacity = $event['capacity'] ?? null;

        return (object) [
            'id' => (string) ($event['id'] ?? md5($title . $description . ($startRaw ?? ''))),
            'title' => $title,
            'description' => $description,
            'start_at' => $startAt,
            'location' => $location,
            'participants' => $participants,
            'capacity' => $capacity,
            'is_active' => true,
        ];
    }

    private function paginateCollection(Collection $collection, int $perPage, Request $request): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $total = $collection->count();
        $results = $collection->forPage($page, $perPage)->values();

        return new LengthAwarePaginator(
            $results,
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );
    }

    public function create()
    {
        abort(403, 'Pembuatan event hanya melalui aplikasi AgendaCerdas.');
    }

    public function store(Request $request)
    {
        abort(403, 'Pembuatan event hanya melalui aplikasi AgendaCerdas.');
    }

    public function edit(CalendarEvent $calendar)
    {
        // If JSON is requested, return JSON
        if (request()->wantsJson()) {
            return response()->json($calendar);
        }
        
        return view('admin.calendar.edit', ['item' => $calendar]);
    }

    public function update(Request $request, CalendarEvent $calendar)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'participants' => 'nullable|integer|min:0',
            'is_active' => 'nullable|in:0,1,on,true,false',
        ]);

        $data['is_active'] = $request->has('is_active') ? true : false;

        try {
            $calendar->update($data);
        } catch (\Exception $e) {
            // Jika field belum ada di database, hapus dan update tanpa field
            if (strpos($e->getMessage(), 'Unknown column') !== false) {
                unset($data['capacity'], $data['participants']);
                $calendar->update($data);
            } else {
                throw $e;
            }
        }

        return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil diperbarui!');
    }

    public function destroy(CalendarEvent $calendar)
    {
        try {
            $title = $calendar->title;
            $calendar->delete();
            
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Event berhasil dihapus!'
                ]);
            }
            
            return redirect()->route('admin.calendar.index')->with('success', '✓ Event berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus event: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', '✗ Gagal menghapus event');
        }
    }
}
