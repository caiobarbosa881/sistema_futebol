<?php
namespace App\Services;

interface FutebolApiServiceInterface
{
    public function getCompeticoes(): array;
    public function getCompeticaoJogos(int $competicaoId): array;
    public function getDetalhesTime(int $teamId): array;
    public function getUltimosResultados(int $teamId): array;
    public function getTimes(): array;
}
