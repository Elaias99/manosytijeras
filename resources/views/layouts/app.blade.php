<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Manos y Tijeras' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root{
            --bg:#f6f7f9;
            --card:#ffffff;
            --text:#111827;
            --muted:#6b7280;
            --border:#e5e7eb;
            --brand:#111827;
            --primary:#2563eb;
        }
        *{ box-sizing:border-box; }
        body{
            margin:0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Arial, "Noto Sans", "Helvetica Neue", sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .container{
            max-width: 1120px;
            margin: 0 auto;
            padding: 18px;
        }

        /* Header moderno */
        .app-header{
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(17,24,39,.92);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .header-inner{
            max-width: 1120px;
            margin: 0 auto;
            padding: 12px 18px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap: 12px;
        }
        .brand{
            display:flex;
            align-items:center;
            gap: 10px;
            color:#fff;
            text-decoration:none;
            font-weight: 900;
            letter-spacing:.2px;
        }
        .brand-badge{
            width:34px;
            height:34px;
            border-radius: 12px;
            background: rgba(255,255,255,.10);
            display:flex;
            align-items:center;
            justify-content:center;
            border: 1px solid rgba(255,255,255,.12);
            font-weight: 900;
        }

        .nav{
            display:flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items:center;
        }
        .nav a{
            color:#fff;
            text-decoration:none;
            font-weight: 800;
            font-size: 14px;
            padding: 9px 12px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.06);
        }
        .nav a:hover{
            background: rgba(255,255,255,.12);
        }
        .nav a.active{
            background: #fff;
            color: #111827;
            border-color: #fff;
        }

        /* Mensajes */
        .alert{
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid var(--border);
            background: var(--card);
            box-shadow: 0 2px 10px rgba(0,0,0,.04);
            margin-bottom: 14px;
        }
        .alert-success{
            border-color:#86efac;
            background:#ecfdf5;
            color:#065f46;
        }
        .alert-danger{
            border-color:#fecaca;
            background:#fef2f2;
            color:#7f1d1d;
        }


        /* Loader */
          .page-loader{
            position:fixed;
            inset:0;
            display:none;
            align-items:center;
            justify-content:center;
            background: rgba(17,24,39,.35);
            z-index: 9999;
            padding: 18px;
        }
        .page-loader.is-visible{ display:flex; }

        .page-loader__card{
            background:#fff;
            border:1px solid #e5e7eb;
            border-radius:16px;
            padding:16px 18px;
            display:flex;
            align-items:center;
            gap:14px;
            box-shadow: 0 10px 30px rgba(0,0,0,.18);
            max-width: 360px;
            width: 100%;
        }


        .nav-btn{
            color:#fff;
            text-decoration:none;
            font-weight:800;
            font-size:14px;
            padding:9px 12px;
            border-radius:999px;
            border:1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.06);
            cursor:pointer;
            font-family: inherit;
        }

        .nav-btn:hover{
            background: rgba(255,255,255,.12);
        }







        .page-loader__scissors{
            position: relative;
            width: 54px;
            height: 54px;
            flex: 0 0 auto;
            animation: scissors-float 1.15s ease-in-out infinite;
        }

        .page-loader__scissors .blade{
            position: absolute;
            left: 24px;
            top: 25px;
            width: 22px;
            height: 4px;
            border-radius: 999px;
            background: linear-gradient(90deg, #6b7280 0%, #111827 100%);
            transform-origin: 2px 50%;
        }

        .page-loader__scissors .blade--top{
            animation: blade-top .75s ease-in-out infinite alternate;
        }

        .page-loader__scissors .blade--bottom{
            animation: blade-bottom .75s ease-in-out infinite alternate;
        }

        .page-loader__scissors .pivot{
            position: absolute;
            left: 20px;
            top: 21px;
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #2563eb;
            border: 2px solid #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,.18);
            z-index: 2;
        }

        .page-loader__scissors .handle{
            position: absolute;
            width: 14px;
            height: 14px;
            border: 3px solid #2563eb;
            border-radius: 999px;
            background: #fff;
        }

        .page-loader__scissors .handle--left{
            left: 4px;
            top: 12px;
        }

        .page-loader__scissors .handle--right{
            left: 4px;
            top: 28px;
        }

        @keyframes blade-top{
            from { transform: rotate(-22deg); }
            to   { transform: rotate(-2deg); }
        }

        @keyframes blade-bottom{
            from { transform: rotate(22deg); }
            to   { transform: rotate(2deg); }
        }

        @keyframes scissors-float{
            0%, 100% { transform: translateY(0) rotate(-4deg); }
            50%      { transform: translateY(-2px) rotate(4deg); }
        }

        @media (prefers-reduced-motion: reduce){
            .page-loader__scissors,
            .page-loader__scissors .blade{
                animation: none;
            }
        }






        .page-loader__title{
            font-weight: 900;
            font-size: 16px;
            color:#111827;
            margin:0;
        }




        .page-loader__subtitle{
            font-size: 13px;
            color:#6b7280;
            margin-top:4px;
        }

        @keyframes spin { to { transform: rotate(360deg); } }
        




        footer{
            color: var(--muted);
            font-size: 13px;
            padding: 18px;
        }
        .footer-inner{
            max-width: 1120px;
            margin: 0 auto;
            text-align:center;
        }
    </style>
</head>

<body>
    <header class="app-header">
        <div class="header-inner">
            <a class="brand" href="{{ route('clients.index') }}">
                <span>Manos y Tijeras</span>
            </a>

            <nav class="nav">
                <a href="{{ route('clients.index') }}" class="{{ request()->routeIs('clients.index') ? 'active' : '' }}">
                    Clientes
                </a>
                <a href="{{ route('help.index') }}" class="{{ request()->routeIs('help.index') ? 'active' : '' }}">
                    Ayuda
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="nav-btn">
                            Cerrar sesión
                        </button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa estos campos:</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>


    <div id="pageLoader" class="page-loader" aria-hidden="true">
    <div class="page-loader__card" role="status" aria-live="polite" aria-label="Cargando">


        <div class="page-loader__scissors" aria-hidden="true">
            <span class="blade blade--top"></span>
            <span class="blade blade--bottom"></span>
            <span class="pivot"></span>
            <span class="handle handle--left"></span>
            <span class="handle handle--right"></span>
        </div>




        <div>
        <div class="page-loader__title">Cargando…</div>
        <div class="page-loader__subtitle">Por favor espera</div>
        </div>
    </div>
    </div>

    <footer>
        <div class="footer-inner">
            © Manos y Tijeras
        </div>
    </footer>

    @stack('scripts')


    <script>
        (function () {
        const loader = document.getElementById('pageLoader');
        if (!loader) return;

        const show = () => {
            loader.classList.add('is-visible');
            loader.setAttribute('aria-hidden', 'false');
        };

        const hide = () => {
            loader.classList.remove('is-visible');
            loader.setAttribute('aria-hidden', 'true');
        };

        // Mostrar al enviar formularios
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;

            // Si alguna vez quieres excluir un form: <form data-no-loader ...>
            if (form.hasAttribute('data-no-loader')) return;

            show();

            // Evita doble click: deshabilita submits del form
            const submits = form.querySelectorAll('button[type="submit"], input[type="submit"]');
            submits.forEach(btn => btn.disabled = true);
        }, true);

        // Mostrar al navegar por links internos (misma pestaña)
        document.addEventListener('click', (e) => {
            const a = e.target.closest('a');
            if (!a) return;

            // Excluir links si quieres: <a data-no-loader ...>
            if (a.hasAttribute('data-no-loader')) return;

            // Si abre en otra pestaña, no mostrar loader
            if (a.target && a.target !== '_self') return;

            const href = a.getAttribute('href');
            if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;

            // Si el usuario usa ctrl/cmd/shift para nueva pestaña, no mostrar
            if (e.metaKey || e.ctrlKey || e.shiftKey || e.altKey || e.button !== 0) return;

            // Solo enlaces del mismo sitio (evita mostrar loader en WhatsApp/tel externos)
            try {
            const url = new URL(href, window.location.href);
            if (url.origin !== window.location.origin) return;
            } catch (_) {}

            show();
        }, true);

        // Si el usuario vuelve con el botón "Atrás" y el navegador restaura caché, esconder loader
        window.addEventListener('pageshow', (evt) => {
            if (evt.persisted) hide();
        });
        })();
    </script>


</body>
</html>