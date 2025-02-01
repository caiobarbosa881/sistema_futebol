<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nome do Site')</title>
    <!-- Linkando o Bootstrap (ou outro framework CSS) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Outros links para fontes, ícones, etc -->
    @yield('head') <!-- Se você precisar incluir conteúdo adicional no head -->
</head>

<body>
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Conteúdo da página -->
    <div class="container mt-4">
        @yield('content') <!-- O conteúdo específico de cada página será inserido aqui -->
    </div>

    <!-- Footer -->

    <footer class="bg-dark text-white text-center py-4 mt-4">
        <p>&copy; 2025 Futebol Sistemas. Todos os direitos reservados.</p>
    </footer>


    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
