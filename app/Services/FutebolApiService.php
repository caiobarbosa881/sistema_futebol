<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FutebolApiService implements FutebolApiServiceInterface
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.football.api_key');
        $this->baseUrl = config('services.football.base_url');
    }

    private function makeRequest(string $endpoint)
    {
        $response = Http::withHeaders(['X-Auth-Token' => $this->apiKey])->get($this->baseUrl . $endpoint);

        if ($response->failed()) {
            return [];
        }

        return $response->json();
    }

    public function getCompeticoes(): array
    {
        return $this->makeRequest('competitions');
    }

    public function getCompeticaoJogos(int $competicaoId): array
    {
        return $this->makeRequest("competitions/{$competicaoId}/matches");
    }

    public function getDetalhesTime(int $teamId): array
    {
        $detalhes = $this->makeRequest("teams/{$teamId}");
        $matches = $this->makeRequest("teams/{$teamId}/matches");

        return [
            'detalhes' => $detalhes,
            'matches' => $matches,
            'competicoes' => $detalhes['runningCompetitions'] ?? [],
        ];
    }

    public function getUltimosResultados(int $teamId): array
    {
        return $this->makeRequest("matches?team={$teamId}&status=FINISHED")['matches'] ?? [];
    }

    public function getTimes(): array
    {
        return $this->makeRequest('teams')['teams'] ?? [];
    }
}
