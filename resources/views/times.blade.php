@extends('partials.app')

@section('title', 'Escolha o Time')

@section('content')

<h1>Times de Futebol</h1>

@if(count($times) > 0)
    <form id="timeForm" action="{{ route('times.detalhes') }}" method="GET">
        <div class="mb-3">
            <label for="time" class="form-label">Escolha um time:</label>
            <select name="id" id="time" class="form-select" required>
                <option value="" disabled selected>Selecione um time</option>

                @foreach($times as $time)
                    <option value="{{ $time['id'] }}">
                        {{ $time['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Ver Detalhes</button>
    </form>


@else
    <p>Não há times disponíveis para esta competição.</p>
@endif

@endsection
