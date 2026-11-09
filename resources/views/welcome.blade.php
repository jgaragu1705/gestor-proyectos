
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de proyectos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <header class="bg-white shadow">
        <nav class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">

            <h1 class="text-xl font-bold">
                Gestor de proyectos
            </h1>

            <div>
                @guest
                    <a href="{{ route('login') }}" class="mr-4 hover:text-indigo-600">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="hover:text-indigo-600">
                        Registrarse
                    </a>
                @endguest

                @auth
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600">
                        Mis proyectos
                    </a>
                @endauth
            </div>

        </nav>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-20 text-center">

        <h2 class="text-4xl font-bold mb-6">
            Organiza tus proyectos fácilmente
        </h2>

        <p class="text-lg mb-8">
            Gestiona tus proyectos, asigna participantes,
            organiza sus roles y controla las horas de trabajo
            desde una única plataforma.
        </p>

        @guest
            <a href="{{ route('register') }}"
               class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                Empezar
            </a>
        @endguest

        @auth
            <a href="{{ route('projects.index') }}"
               class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700">
                Ir a mis proyectos
            </a>
        @endauth

    </main>

    <section class="max-w-5xl mx-auto px-4 pb-20">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-bold mb-3">
                    Crear proyectos
                </h3>

                <p>
                    Crea y organiza tus proyectos fácilmente,
                    estableciendo fechas límite y estados.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-bold mb-3">
                    Asignar roles
                </h3>

                <p>
                    Añade participantes a tus proyectos
                    y asigna a cada uno su función.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow">
                <h3 class="text-xl font-bold mb-3">
                    Controlar horas
                </h3>

                <p>
                    Consulta y modifica las horas de
                    contribución de cada participante.
                </p>
            </div>

        </div>

    </section>

</body>
</html>
