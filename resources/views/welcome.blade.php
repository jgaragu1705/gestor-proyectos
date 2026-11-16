<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestor de proyectos colaborativos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <header class="bg-white border-b border-gray-100">
        <nav class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">
                Gestor de proyectos
            </a>

            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-indigo-600">
                        Iniciar sesión
                    </a>

                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Registrarse
                    </a>
                @endguest

                @auth
                    <a href="{{ route('projects.index') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Ir a proyectos
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <section class="max-w-7xl mx-auto px-6 py-20 md:py-28">
            <div class="max-w-3xl mx-auto text-center">
                <span class="inline-block bg-indigo-50 text-indigo-700 text-sm font-semibold px-4 py-2 rounded-full mb-6">
                    Organización y colaboración en un solo lugar
                </span>

                <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-gray-900 leading-tight">
                    Tus proyectos, tu equipo y todo bajo control.
                </h1>

                <p class="text-lg md:text-xl text-gray-500 mt-6 leading-relaxed">
                    Crea proyectos, incorpora participantes, asigna responsabilidades y controla las horas de trabajo de forma sencilla desde una única plataforma.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-3 mt-9">
                    @guest
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-7 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Crear una cuenta
                        </a>

                        <a href="{{ route('login') }}" class="bg-white border border-gray-300 text-gray-700 px-7 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Ya tengo una cuenta
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('projects.index') }}" class="bg-indigo-600 text-white px-7 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                            Acceder a mis proyectos
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <section class="bg-white border-y border-gray-100 py-16">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">
                        Todo lo que necesitas para colaborar
                    </h2>

                    <p class="text-gray-500 mt-3">
                        Herramientas sencillas para organizar el trabajo en equipo.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <article class="bg-gray-50 p-7 rounded-2xl border border-gray-100">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 text-xl font-bold mb-5">
                            01
                        </div>

                        <h3 class="text-lg font-bold mb-3">
                            Organiza tus proyectos
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            Crea proyectos, añade descripciones, establece fechas límite y controla su estado en cada momento.
                        </p>
                    </article>

                    <article class="bg-gray-50 p-7 rounded-2xl border border-gray-100">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 text-xl font-bold mb-5">
                            02
                        </div>

                        <h3 class="text-lg font-bold mb-3">
                            Colabora con tu equipo
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            Incorpora participantes a tus proyectos y asigna a cada persona un rol según sus responsabilidades.
                        </p>
                    </article>

                    <article class="bg-gray-50 p-7 rounded-2xl border border-gray-100">
                        <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 text-xl font-bold mb-5">
                            03
                        </div>

                        <h3 class="text-lg font-bold mb-3">
                            Controla las contribuciones
                        </h3>

                        <p class="text-gray-500 leading-relaxed">
                            Registra las horas aportadas por cada participante y consulta el progreso del trabajo realizado.
                        </p>
                    </article>
                </div>
            </div>
        </section>

        <section class="max-w-5xl mx-auto px-6 py-20 text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                Empieza a organizar mejor tu trabajo
            </h2>

            <p class="text-gray-500 mt-4">
                Centraliza tus proyectos y facilita la colaboración con tu equipo.
            </p>

            @guest
                <a href="{{ route('register') }}" class="inline-block mt-7 bg-indigo-600 text-white px-7 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Regístrate gratis
                </a>
            @endguest

            @auth
                <a href="{{ route('projects.index') }}" class="inline-block mt-7 bg-indigo-600 text-white px-7 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Ver mis proyectos
                </a>
            @endauth
        </section>
    </main>

    <footer class="bg-white border-t border-gray-100 py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-500">
            Gestor de proyectos colaborativos
        </div>
    </footer>

</body>
</html>