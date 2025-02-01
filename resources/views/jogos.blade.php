@extends('partials.app')

@section('title', 'Acesse as Partidas/Jogos')

@section('content')
<h1 class="text-center">Informações do campeonato/competição: </h1>
<h2 class="text-center m-4">{{ $jogos['competition']['name'] }}</h2>
@if(isset($jogos) && count($jogos['matches']) > 0)
    @php
        $agora = \Carbon\Carbon::now(); // Data e hora atual
        $jogosFuturos = [];
        $jogosPassados = [];

        // Separar os jogos em futuros e passados
        foreach ($jogos['matches'] as $jogo) {
            $dataJogo = \Carbon\Carbon::parse($jogo['utcDate']);
            if ($dataJogo->isFuture()) {
                $jogosFuturos[] = $jogo;
            } else {
                $jogosPassados[] = $jogo;
            }
        }
    @endphp
    {{-- Se houver jogos futuros --}}
    @if(count($jogosFuturos) > 0)
        <h2 class="text-center m-4">Próximos Jogos</h2>
        <div class="row bg-warning pt-4 pb-4">
            @foreach($jogosFuturos as $jogo)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            @if(empty($jogo['homeTeam']['name']) || empty($jogo['awayTeam']['name']) || empty($jogo['utcDate']))
                                <p class="card-text">Dados dessa futura partida incompletos. Tente novamente mais tarde.</p>
                            @else
                                <h5 class="card-title">
                                    {{ $jogo['homeTeam']['name'] }} vs {{ $jogo['awayTeam']['name'] }}
                                </h5>
                                <p class="card-text">
                                    Data: {{ \Carbon\Carbon::parse($jogo['utcDate'])->format('d/m/Y H:i') }}
                                </p>
                                <p class="card-text">
                                    Estádio: {{ $jogo['venue'] ?? 'Não disponível' }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(count($jogosPassados) > 0)
        <h2 class="text-center m-4">Jogos Passados</h2>
        <div class="row bg-secondary pt-4 pb-4">
            @foreach($jogosPassados as $jogo)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            @if(empty($jogo['homeTeam']['name']) || empty($jogo['awayTeam']['name']) || empty($jogo['utcDate']))
                                <p class="card-text">Dados dessa partida incompletos. Tente novamente mais tarde.</p>
                            @else
                                <h5 class="card-title">
                                    {{ $jogo['homeTeam']['name'] }} vs {{ $jogo['awayTeam']['name'] }}
                                </h5>
                                <p class="card-text">
                                    Data: {{ \Carbon\Carbon::parse($jogo['utcDate'])->format('d/m/Y H:i') }}
                                </p>
                                <p class="card-text">
                                    @if($jogo['score']['winner'] === 'HOME_TEAM')
                                        <span class="text-success fw-bold">{{ $jogo['homeTeam']['name'] }}</span>
                                        {{ $jogo['score']['fullTime']['home']}} X {{ $jogo['score']['fullTime']['away'] }} <span
                                            class="text-danger fw-bold">{{ $jogo['awayTeam']['name'] }}</span>
                                    @elseif($jogo['score']['winner'] === 'DRAW')
                                        <span class="text-warning fw-bold">{{ $jogo['homeTeam']['name'] }}</span>
                                        {{ $jogo['score']['fullTime']['home']}} X {{ $jogo['score']['fullTime']['away'] }} <span
                                            class="text-warning fw-bold">{{ $jogo['awayTeam']['name'] }}</span>
                                    @else($jogo['score']['winner'] === 'AWAY_TEAM')
                                        <span class="text-success fw-bold">{{ $jogo['awayTeam']['name'] }}</span>
                                        {{ $jogo['score']['fullTime']['away'] }} X
                                        {{ $jogo['score']['fullTime']['home']}} <span
                                            class="text-danger fw-bold">{{ $jogo['homeTeam']['name'] }}</span>
                                    @endif
                                </p>
                                @if(isset($jogo['venue']) && !empty($jogo['venue']))
                                    <p class="card-text">
                                        Estádio: {{ $jogo['venue'] }}
                                    </p>
                                @else
                                    <p class="card-text">
                                        Estádio: Não disponível
                                    </p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@elseif(isset($erro))
    <p>{{ $erro }}</p>
@else
    <p class="text-center m-4 fw-bold">
        Nenhum jogo dessa competição foi encontrado!
        <a href="{{ route('competicoes.index') }}" class="text-decoration-none text-primary">Tente Selecionar outra competição/campeonato
            clicando aqui</a>.
    </p>
@endif
@endsection
