<?php
namespace App\Services;

use App\Models\AgendaIntegration;
use Illuminate\Support\Facades\Http;

class AgendaCerdasService
{
    public function integration(): AgendaIntegration
    {
        $integration = AgendaIntegration::firstOrCreate(
            ['id' => 1],
            ['base_url' => $this->resolvedBaseUrl()]
        );

        $resolvedBaseUrl = $this->resolvedBaseUrl();

        if ($resolvedBaseUrl !== $integration->base_url) {
            $integration->update(['base_url' => $resolvedBaseUrl]);
            $integration->refresh();
        }

        return $integration;
    }

    public function login(string $username, string $password): array
    {
        $integration = $this->integration();

        $res = Http::acceptJson()->post("{$integration->base_url}/api/v1/auth/login", [
            'username' => $username,
            'password' => $password,
        ])->throw()->json();

        $integration->update([
            'username' => $username,
            'access_token' => $res['token'] ?? null,
            'refresh_token' => $res['refreshToken'] ?? null,
            'connected_at' => now(),
        ]);

        return $res;
    }

    public function refreshToken(): void
    {
        $integration = $this->integration();

        $res = Http::acceptJson()
            ->post("{$integration->base_url}/api/v1/auth/refresh", [
                'refreshToken' => $integration->refresh_token,
            ])->throw()->json();

        $integration->update([
            'access_token' => $res['token'] ?? null,
            'refresh_token' => $res['refreshToken'] ?? null,
        ]);
    }

    public function calendars(): array
    {
        return $this->authorizedGet('/api/v1/user/calendars')['calendars'] ?? [];
    }

    public function agenda(string $calendarName, ?string $startDate = null, ?string $endDate = null): array
    {
        if ($startDate && $endDate) {
            return $this->authorizedGet('/api/v1/user/agenda-by-date', [
                'calendarName' => $calendarName,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        }

        return $this->authorizedGet('/api/v1/user/agenda', [
            'calendarName' => $calendarName,
        ]);
    }

    private function authorizedGet(string $path, array $query = []): array
    {
        $integration = $this->integration();

        $request = fn() => Http::acceptJson()
            ->withToken($integration->access_token)
            ->get("{$integration->base_url}{$path}", $query);

        $res = $request();

        if ($res->status() === 401) {
            $this->refreshToken();
            $integration->refresh();
            $res = $request();
        }

        return $res->throw()->json();
    }

    private function resolvedBaseUrl(): string
    {
        $baseUrl = config('services.agendacerdas.base_url') ?: env('AGENDACERDAS_BASE_URL');

        return rtrim((string) $baseUrl, '/');
    }
}