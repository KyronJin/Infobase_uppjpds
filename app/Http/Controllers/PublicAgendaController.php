<?php
namespace App\Http\Controllers;

use App\Services\AgendaCerdasService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicAgendaController extends Controller
{
    public function index(Request $request, AgendaCerdasService $service)
    {
        $integration = $service->integration();
        $selected = collect($integration->selected_calendars ?? [])->filter()->values();

        $start = $request->query('startDate');
        $end = $request->query('endDate');
        $search = trim((string) $request->query('search', ''));

        if ($selected->isEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Belum ada kalender yang dipilih di admin.',
                'summary' => [
                    'totalEvents' => 0,
                    'selectedCalendars' => [],
                ],
                'data' => [
                    'events' => [],
                ],
            ]);
        }

        $events = collect();

        foreach ($selected as $calendarName) {
            $payload = $service->agenda($calendarName, $start, $end);
            $events = $events->merge($this->extractEvents($payload));
        }

        if ($search !== '') {
            $events = $events->filter(function (array $event) use ($search) {
                $haystack = Str::lower(implode(' ', [
                    $event['title'] ?? '',
                    $event['notes'] ?? '',
                    data_get($event, 'room.name', ''),
                ]));

                return Str::contains($haystack, Str::lower($search));
            });
        }

        $events = $events
            ->sortBy(fn ($event) => $event['startTime'] ?? $event['date'] ?? null)
            ->values()
            ->all();

        return response()->json([
            'success' => true,
            'summary' => [
                'totalEvents' => count($events),
                'selectedCalendars' => $selected->all(),
            ],
            'data' => [
                'events' => $events,
            ],
        ]);
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
}