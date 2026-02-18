<?php
namespace App\Http\Controllers;

use App\Services\AgendaCerdasService;
use Illuminate\Http\Request;

class AgendaIntegrationController extends Controller
{
    public function showLogin()
    {
        return view('admin.agenda.login');
    }

    public function login(Request $request, AgendaCerdasService $service)
    {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        try {
            $service->login($data['username'], $data['password']);
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Login gagal: ' . $e->getMessage());
        }

        return redirect()->route('admin.agenda.calendars')->with('ok', 'Integrasi berhasil login');
    }

    public function calendars(AgendaCerdasService $service)
    {
        $integration = $service->integration();

        try {
            $calendars = $service->calendars();
        } catch (\Throwable $e) {
            return redirect()->route('admin.agenda.login')->with('error', 'Gagal mengambil daftar kalender. Silakan login ulang.');
        }

        return view('admin.agenda.calendars', [
            'calendars' => $calendars,
            'selected' => $integration->selected_calendars ?? [],
        ]);
    }

    public function saveCalendars(Request $request, AgendaCerdasService $service)
    {
        $data = $request->validate([
            'selected_calendars' => ['nullable', 'array'],
            'selected_calendars.*' => ['string'],
        ]);

        $selected = array_values(array_unique($data['selected_calendars'] ?? []));

        $service->integration()->update([
            'selected_calendars' => $selected,
        ]);

        return back()->with('ok', 'Kalender public berhasil disimpan');
    }
}