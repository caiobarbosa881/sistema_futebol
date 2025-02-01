<?php

namespace App\Http\Controllers;

use App\Services\FutebolApiServiceInterface;
use Illuminate\Http\Request;

class FutebolController extends Controller
{
    protected $futebolApiService;

    // Injeção de dependência do serviço no controlador
    public function __construct(FutebolApiServiceInterface $futebolApiService)
    {
        $this->futebolApiService = $futebolApiService;
    }

    // Método para exibir as competições
    public function competicoes()
    {
        $competicoes = $this->futebolApiService->getCompeticoes();

        if (empty($competicoes)) {
            return response()->view('erro', [], 500);
        }

        return view('competicoes', compact('competicoes'));
    }

    // Método para exibir os jogos de uma competição
    public function exibirJogos($id)
    {
        $jogos = $this->futebolApiService->getCompeticaoJogos($id);

        if (empty($jogos)) {
            return view('erro');
        }

        return view('jogos', compact('jogos', 'id'));
    }

    // Método para exibir os times
    public function times()
    {
        $times = $this->futebolApiService->getTimes();

        if (empty($times)) {
            return view('erro');
        }

        return view('times', compact('times'));
    }

    // Método para exibir detalhes de um time específico
    public function detalhesTime(Request $request)
    {
        $id = $request->input('id');
        // Obtenção dos detalhes do time baseado no ID
        $dadosTime = $this->futebolApiService->getDetalhesTime($id);

        // Verifica se os dados do time estão disponíveis
        if (empty($dadosTime)) {
            return view('errors.erroTimes');
        }

        // Retorna a visão de detalhes do time
        return view('detalhes_time', [
            'time' => $dadosTime['detalhes'],
            'competicoes' => $dadosTime['competicoes'],
            'ultimosResultados' => $this->futebolApiService->getUltimosResultados($id),
            'particularTeamMatches' => $dadosTime['matches'],
        ]);
    }

    // Método para exibir partidas de um time específico
    public function exibirPartidasDeUmTime($teamId)
    {
        $matches = $this->futebolApiService->getUltimosResultados($teamId);

        return view('teams.matches', compact('matches'));
    }

    public function selecionarCompeticao(Request $request)
    {
        // Valida se a competição foi selecionada
        $competicaoId = $request->input('competicao'); // Obtém o ID da competição selecionada

        if ($competicaoId) {
            // Redireciona para a página de jogos dessa competição
            return redirect()->route('competicoes.jogos', ['id' => $competicaoId]);
        } else {
            // Caso não tenha sido selecionado nenhuma competição
            return redirect()->route('competicoes.index')->with('error', 'Nenhuma competição selecionada!');
        }
    }
}
