@extends('partials.app')

@section('title', 'Acesse as Partidas/Jogos')

@section('content')
<h1>Detalhes do Time: {{ $time['name'] ?? 'Nome não disponível' }}</h1>

<!-- Exibição do escudo do time -->
<img src="{{ $time['crest'] ?? asset('images/default-team.png') }}" alt="Escudo do Time"
    style="width: 100px; height: 100px;">

<p><strong>Fundado em:</strong> {{ $time['founded'] ?? 'Data não informada' }}</p>
<p><strong>Cores do time:</strong> {{ $time['clubColors'] ?? 'Não disponível' }}</p>
<p><strong>Estádio:</strong> {{ $time['venue'] ?? 'Informação indisponível' }}</p>
<p><strong>Endereço:</strong> {{ $time['address'] ?? 'Não informado' }}</p>
<p><strong>Website:</strong>
    @if(isset($time['website']))
        <a href="{{ $time['website'] }}" target="_blank">{{ $time['website'] }}</a>
    @else
        Não disponível
    @endif
</p>

<h2>Próximas Partidas</h2>
@if(!empty($particularTeamMatches['matches']))
    <ul>
        @foreach(array_reverse($particularTeamMatches['matches']) as $match)
            @if($match['status'] === 'TIMED')
                <li class="match-result">
                    <span class="text-muted me-3">{{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}</span>
                    <span class="text-success fw-bold">{{ $match['homeTeam']['name'] }}</span>
                    X
                    <span class="text-danger fw-bold">{{ $match['awayTeam']['name'] }}</span>
                </li>
            @endif
        @endforeach
    </ul>
@else
    <p>Não há próximas partidas agendadas para o time.</p>
@endif

<h2>Últimos Resultados</h2>
@if(!empty($particularTeamMatches['matches']))
    <ul>
        @foreach(array_reverse($particularTeamMatches['matches']) as $match)
            @if($match['status'] === 'FINISHED')
                @if($match['score']['winner'] === 'HOME_TEAM')
                    <li class="match-result">
                        <span class="text-muted me-3">{{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}</span>
                        <span class="text-success fw-bold">{{ $match['homeTeam']['name'] }}</span>
                        {{ $match['score']['fullTime']['home'] }} X {{ $match['score']['fullTime']['away'] }}
                        <span class="text-danger fw-bold">{{ $match['awayTeam']['name'] }}</span>
                    </li>
                @elseif($match['score']['winner'] === 'DRAW')
                    <li class="match-result">
                        <span class="text-muted me-3">{{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}</span>
                        <span class="text-warning fw-bold">{{ $match['homeTeam']['name'] }}</span>
                        {{ $match['score']['fullTime']['home'] }} X {{ $match['score']['fullTime']['away'] }}
                        <span class="text-warning fw-bold">{{ $match['awayTeam']['name'] }}</span>
                    </li>
                @else
                    <li class="match-result">
                        <span class="text-muted me-3">{{ \Carbon\Carbon::parse($match['utcDate'])->format('d/m/Y H:i') }}</span>
                        <span class="text-success fw-bold">{{ $match['awayTeam']['name'] }}</span>
                        {{ $match['score']['fullTime']['away'] }} X {{ $match['score']['fullTime']['home'] }}
                        <span class="text-danger fw-bold">{{ $match['homeTeam']['name'] }}</span>
                    </li>
                @endif
            @endif
        @endforeach
    </ul>
@else
    <p>Não há partidas concluídas para exibir.</p>
@endif

<h2>Competições em Andamento</h2>
@if(!empty($competicoes))
    <ul>
        @foreach($competicoes as $competicao)
            <li>
                {{ $competicao['name'] ?? 'Nome da competição não disponível' }}
                <img src="{{ $competicao['emblem'] ?? asset('images/default-competition.png') }}"
                    alt="{{ $competicao['name'] ?? 'Competição' }} logo" style="width: 20px; height: 20px;">
            </li>
        @endforeach
    </ul>
@else
    <p>Este time não está participando de competições no momento.</p>
@endif

@endsection
