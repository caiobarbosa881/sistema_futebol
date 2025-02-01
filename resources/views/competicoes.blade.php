@extends('partials.app')

@section('title', 'Acesse Campeonatos/Competições de Futebol')

@section('content')
<h1 class="mb-3">Lista de Competições de Futebol</h1>
@if(count($competicoes['competitions']) > 0)
    <form action="{{ route('competicoes.selecionar') }}" method="POST" class="p-4 border rounded shadow-sm">
        @csrf <!-- Proteção CSRF -->

        <div class="mb-3">
            <label for="competicao" class="form-label">Escolha uma competição:</label>
            <select name="competicao" id="competicao" class="form-select">
                <option value="" disabled selected>Selecione uma competição</option>
                @foreach($competicoes['competitions'] as $competicao)
                    <option value="{{ $competicao['id'] }}">
                        {{ $competicao['name'] }} - {{ $competicao['area']['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Selecionar</button>
    </form>
@else
    <p>Não há competições disponíveis no momento.</p>
@endif
@endsection
