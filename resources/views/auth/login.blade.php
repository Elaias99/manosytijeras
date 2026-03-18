<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | Manos y Tijeras</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root{
            --bg-1: #1c2746;
            --bg-2: #243154;
            --panel-left: #f3f4f6;
            --panel-right: #5e6983;
            --text-main: #111827;
            --text-soft: #6b7280;
            --text-label: #7b7b85;
            --line: #d9dde5;
            --white: #ffffff;
            --navy: #1f2b4d;
            --navy-2: #263457;
            --shadow-soft: 0 10px 30px rgba(0,0,0,.10);
            --shadow-btn: 0 10px 18px rgba(31,43,77,.18);
            --radius-xl: 34px;
            --radius-lg: 20px;
            --radius-md: 14px;
            --radius-sm: 12px;
        }

        *{
            box-sizing: border-box;
        }

        html, body{
            margin: 0;
            padding: 0;
            min-height: 100%;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at top left, #2b3659 0%, #1d2848 45%, #192442 100%);
        }

        body{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-shell{
            width: 100%;
            max-width: 1130px;
            min-height: 760px;
            border-radius: var(--radius-xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 420px 1fr;
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.16);
            box-shadow: 0 25px 70px rgba(0,0,0,.28);
        }

        .left-panel{
            background: #f4f4f6;
            padding: 40px 44px 28px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .right-panel{
            position: relative;
            padding: 36px;
            background:
                linear-gradient(135deg, rgba(255,255,255,.06), rgba(255,255,255,.03)),
                radial-gradient(circle at 30% 18%, rgba(255,255,255,.14), rgba(255,255,255,0) 25%),
                radial-gradient(circle at 62% 56%, rgba(255,255,255,.12), rgba(255,255,255,0) 18%),
                linear-gradient(180deg, #556079 0%, #737d95 100%);
            isolation: isolate;
        }

        .right-panel::before{
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(
                    90deg,
                    rgba(34,47,81,.60) 0%,
                    rgba(255,255,255,.05) 22%,
                    rgba(37,49,82,.10) 38%,
                    rgba(255,255,255,.06) 53%,
                    rgba(34,47,81,.18) 68%,
                    rgba(255,255,255,.04) 82%,
                    rgba(255,255,255,.02) 100%
                );
            filter: blur(12px);
            opacity: .95;
            z-index: -1;
        }

        .brand-row{
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 26px;
        }

        .brand-icon{
            width: 48px;
            height: 48px;
            min-width: 48px;
            border-radius: 16px;
            background: var(--navy);
            display: grid;
            place-items: center;
            color: white;
            box-shadow: var(--shadow-soft);
        }

        .brand-text{
            padding-top: 4px;
        }

        .brand-name{
            margin: 0;
            font-size: 13px;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: #808696;
            font-weight: 800;
        }

        .brand-sub{
            margin: 4px 0 0;
            font-size: 14px;
            color: #686f7f;
            font-weight: 500;
        }

        .form-area{
            max-width: 100%;
        }

        .title{
            font-size: 33px;
            line-height: 1.05;
            margin: 0;
            font-weight: 800;
            letter-spacing: -.03em;
            color: #152038;
        }

        .subtitle{
            margin: 12px 0 0;
            font-size: 16px;
            color: #767b86;
            line-height: 1.45;
        }

        .user-badge{
            width: 118px;
            height: 118px;
            border-radius: 999px;
            margin: 38px auto 42px;
            background: var(--navy);
            display: grid;
            place-items: center;
            color: white;
            box-shadow: 0 18px 30px rgba(31,43,77,.20);
        }

        .alert{
            margin-bottom: 18px;
            border-radius: 14px;
            padding: 12px 14px;
            font-size: 14px;
            line-height: 1.4;
        }

        .alert-error{
            background: #fff1f2;
            color: #9f1239;
            border: 1px solid #fecdd3;
        }

        .alert-success{
            background: #ecfeff;
            color: #155e75;
            border: 1px solid #a5f3fc;
        }

        .field{
            margin-bottom: 18px;
        }

        .label{
            display: block;
            margin-bottom: 10px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .22em;
            text-transform: uppercase;
            color: #87838d;
        }

        .input-wrap{
            position: relative;
        }

        .input-icon{
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #9b9ba3;
            pointer-events: none;
        }

        .toggle-pass{
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border: none;
            background: transparent;
            color: #9b9ba3;
            cursor: pointer;
            display: grid;
            place-items: center;
            border-radius: 999px;
        }

        .toggle-pass:hover{
            background: rgba(31,43,77,.05);
        }

        .input{
            width: 100%;
            height: 56px;
            border-radius: 18px;
            border: 1px solid #d8dce4;
            background: #ffffff;
            padding: 0 18px 0 48px;
            font-size: 16px;
            color: #2a2e38;
            outline: none;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.55), 0 2px 6px rgba(0,0,0,.05);
            transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
        }

        .input-password{
            padding-right: 52px;
        }

        .input:focus{
            border-color: #9fb0d4;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .10);
        }

        .input.is-invalid{
            border-color: #fda4af;
            box-shadow: 0 0 0 4px rgba(244, 63, 94, .08);
        }

        .error-text{
            display: block;
            margin-top: 8px;
            font-size: 13px;
            color: #be123c;
            font-weight: 600;
        }

        .submit-btn{
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 18px;
            background: var(--navy-2);
            color: white;
            font-size: 15px;
            font-weight: 900;
            letter-spacing: .16em;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: var(--shadow-btn);
            transition: transform .18s ease, opacity .18s ease, box-shadow .18s ease;
        }

        .submit-btn:hover{
            transform: translateY(-1px);
            box-shadow: 0 14px 22px rgba(31,43,77,.24);
        }

        .submit-btn:active{
            transform: translateY(0);
        }

        .options-row{
            margin-top: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        .remember{
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #7a7d86;
            font-size: 15px;
        }

        .remember input{
            width: 16px;
            height: 16px;
            accent-color: #1e88e5;
        }

        .forgot-text{
            color: #7a7d86;
            font-size: 15px;
            user-select: none;
        }

        .pager{
            margin-top: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .pager-dot{
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #b8bec9;
        }

        .pager-dot.active{
            width: 22px;
            background: var(--navy);
        }

        .right-top{
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .pill{
            display: inline-flex;
            align-items: center;
            min-height: 38px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.13);
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.88);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .status-badge{
            min-height: 38px;
            padding: 0 16px;
            border-radius: 999px;
            border: 1px solid rgba(255,255,255,.12);
            background: rgba(255,255,255,.08);
            color: rgba(255,255,255,.90);
            font-size: 13px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .right-bottom-card{
            position: absolute;
            left: 34px;
            right: 34px;
            bottom: 34px;
            border-radius: 26px;
            padding: 28px 28px 30px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.10);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.04);
        }

        .right-bottom-left{
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mini-icon{
            width: 54px;
            height: 54px;
            border-radius: 18px;
            background: #fbfbfc;
            color: var(--navy);
            display: grid;
            place-items: center;
            box-shadow: 0 8px 18px rgba(0,0,0,.08);
        }

        .rb-small{
            margin: 0 0 4px;
            color: rgba(255,255,255,.66);
            text-transform: uppercase;
            letter-spacing: .20em;
            font-size: 12px;
            font-weight: 800;
        }

        .rb-title{
            margin: 0;
            color: white;
            font-size: 23px;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .rb-square{
            width: 52px;
            height: 52px;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,.10);
            background: rgba(255,255,255,.06);
            flex: 0 0 auto;
        }

        svg{
            display: block;
        }

        @media (max-width: 980px){
            .login-shell{
                grid-template-columns: 1fr;
                max-width: 540px;
                min-height: auto;
            }

            .right-panel{
                display: none;
            }

            .left-panel{
                border-radius: var(--radius-xl);
                min-height: auto;
            }
        }

        @media (max-width: 640px){
            body{
                padding: 14px;
            }

            .left-panel{
                padding: 28px 22px 22px;
            }

            .title{
                font-size: 28px;
            }

            .subtitle{
                font-size: 15px;
            }

            .user-badge{
                width: 100px;
                height: 100px;
                margin: 28px auto 30px;
            }

            .options-row{
                align-items: flex-start;
                flex-direction: column;
            }

            .forgot-text{
                padding-left: 2px;
            }
        }
    </style>
</head>
<body>
    <div class="login-shell">
        <section class="left-panel">
            <div>
                <div class="brand-row">
                    <!-- <div class="brand-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <circle cx="6.25" cy="7.25" r="2.75" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="6.25" cy="16.75" r="2.75" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M8.5 9L18.8 19.2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8.5 15L18.8 4.8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.4 12L18.8 12" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div> -->

                    <div class="brand-text">
                        <p class="brand-name">Manos y Tijeras</p>
                        <p class="brand-sub">Acceso interno</p>
                    </div>
                </div>

                <div class="form-area">
                    <h1 class="title">Iniciar sesión</h1>
                    <p class="subtitle">Ingresa tus credenciales para continuar.</p>

                    <div class="user-badge" aria-hidden="true">
                        <svg width="46" height="46" viewBox="0 0 24 24" fill="none">
                            <path d="M12 12C14.2091 12 16 10.2091 16 8C16 5.79086 14.2091 4 12 4C9.79086 4 8 5.79086 8 8C8 10.2091 9.79086 12 12 12Z" stroke="currentColor" stroke-width="1.7"/>
                            <path d="M5 20C5 16.6863 8.13401 14 12 14C15.866 14 19 16.6863 19 20" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                        </svg>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error">
                            Credenciales incorrectas. Verifica el correo y la contraseña.
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        <div class="field">
                            <label class="label" for="email">Correo electrónico</label>
                            <div class="input-wrap">
                                <span class="input-icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M4 7.5C4 6.12 5.12 5 6.5 5H17.5C18.88 5 20 6.12 20 7.5V16.5C20 17.88 18.88 19 17.5 19H6.5C5.12 19 4 17.88 4 16.5V7.5Z" stroke="currentColor" stroke-width="1.8"/>
                                        <path d="M5 7L12 12.25L19 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>

                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    class="input @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="correo@ejemplo.com"
                                >
                            </div>
                            @error('email')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="label" for="password">Contraseña</label>
                            <div class="input-wrap">
                                <span class="input-icon" aria-hidden="true">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M7 10V8.5C7 5.73858 9.23858 3.5 12 3.5C14.7614 3.5 17 5.73858 17 8.5V10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <rect x="4" y="10" width="16" height="10" rx="2.5" stroke="currentColor" stroke-width="1.8"/>
                                    </svg>
                                </span>

                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    class="input input-password @error('password') is-invalid @enderror"
                                    required
                                    autocomplete="current-password"
                                    placeholder="••••••••"
                                >

                                <button type="button" class="toggle-pass" id="togglePassword" aria-label="Mostrar u ocultar contraseña">
                                    <svg id="eyeOpen" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                        <path d="M2 12C3.8 8.5 7.4 6 12 6C16.6 6 20.2 8.5 22 12C20.2 15.5 16.6 18 12 18C7.4 18 3.8 15.5 2 12Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                        <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
                                    </svg>

                                    <svg id="eyeClosed" width="20" height="20" viewBox="0 0 24 24" fill="none" style="display:none;">
                                        <path d="M3 3L21 21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                                        <path d="M10.6 6.2C11.05 6.07 11.52 6 12 6C16.6 6 20.2 8.5 22 12C21.18 13.6 20.04 14.95 18.65 15.95M14.12 14.12C13.58 14.66 12.82 15 12 15C10.34 15 9 13.66 9 12C9 11.18 9.34 10.42 9.88 9.88M6.1 8.1C4.41 9.05 3.01 10.39 2 12C3.8 15.5 7.4 18 12 18C13.48 18 14.86 17.74 16.1 17.27" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span class="error-text">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn">Entrar</button>

                        <div class="options-row">
                            <label class="remember">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Recordarme</span>
                            </label>

                            <span class="forgot-text">¿Olvidaste tu contraseña?</span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="pager" aria-hidden="true">
                <span class="pager-dot"></span>
                <span class="pager-dot active"></span>
                <span class="pager-dot"></span>
            </div>
        </section>

        <aside class="right-panel" aria-hidden="true">
            <div class="right-top">
                <div class="pill">Manos y Tijeras</div>
                <div class="status-badge">Privado</div>
            </div>

            <div class="right-bottom-card">
                <div class="right-bottom-left">
                    <!-- <div class="mini-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14.7 6.3L17.7 9.3M7 8L17 18M17.5 6.5C18.9 5.1 21.1 5.1 22.5 6.5C23.9 7.9 23.9 10.1 22.5 11.5L19 15M4.5 22.5L9.8 17.2M3 5.5C1.7 6.8 1.7 8.9 3 10.2C4.3 11.5 6.4 11.5 7.7 10.2L10.2 7.7M12 13L7.2 17.8C5.9 19.1 5.9 21.2 7.2 22.5C8.5 23.8 10.6 23.8 11.9 22.5L16.7 17.7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div> -->

                    <div>
                        <p class="rb-small">Sistema interno</p>
                        <p class="rb-title">Acceso privado</p>
                    </div>
                </div>

                <div class="rb-square"></div>
            </div>
        </aside>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                eyeOpen.style.display = isPassword ? 'none' : 'block';
                eyeClosed.style.display = isPassword ? 'block' : 'none';
            });
        }
    </script>
</body>
</html>