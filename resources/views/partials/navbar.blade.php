<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="{{ route('competicoes.index') }}">
            <i class="fas fa-futbol"></i> Futebol Sistemas
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('competicoes.index') }}">
                        Início
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('competicoes.index') }}">
                        Campeonatos/Competições
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('times.index') }}">
                        Buscar por Time
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
