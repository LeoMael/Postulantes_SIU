<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Postulantes UNAP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a8a;
            --primary-light: #2563eb;
            --primary-dark: #172554;
            --bg-page: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --border-focus: #3b82f6;
            --danger: #ef4444;
            --radius-md: 10px;
            --radius-lg: 16px;
            --shadow-card: 0 10px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            color: var(--text-main);
        }

        .login-wrapper {
            width: 100%;
            max-width: 440px;
            animation: fadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(12px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-card {
            background-color: var(--surface);
            border-radius: var(--radius-lg);
            padding: 2.25rem 2rem;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(255, 255, 255, 0.15);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa, #2563eb);
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.85rem;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background-color: #eff6ff;
            color: var(--primary);
            border: 1px solid #dbeafe;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.25rem 0.65rem;
            border-radius: 999px;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .brand-title {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        .brand-subtitle {
            font-size: 0.825rem;
            color: var(--text-muted);
            margin-top: 0.35rem;
        }

        .alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 0.75rem 0.95rem;
            border-radius: var(--radius-md);
            font-size: 0.815rem;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
            line-height: 1.35;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.4rem;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 0.85rem;
            color: #94a3b8;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            width: 100%;
            height: 42px;
            padding: 0 0.85rem 0 2.45rem;
            font-size: 0.875rem;
            font-family: inherit;
            color: #0f172a;
            background-color: #f8fafc;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            outline: none;
            transition: all 0.15s ease;
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .btn-toggle-pwd {
            position: absolute;
            right: 0.75rem;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease;
        }

        .btn-toggle-pwd:hover {
            color: #475569;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.4rem;
            font-size: 0.8rem;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            color: #475569;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-input {
            width: 15px;
            height: 15px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            height: 42px;
            background-color: var(--primary);
            color: #ffffff;
            font-size: 0.875rem;
            font-weight: 700;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.15s ease;
            box-shadow: 0 2px 4px rgba(30, 58, 138, 0.2);
        }

        .btn-submit:hover {
            background-color: #1e40af;
            box-shadow: 0 4px 6px rgba(30, 58, 138, 0.3);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        .login-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.72rem;
            color: #94a3b8;
        }

        .footer-note {
            margin-top: 1rem;
            padding-top: 0.85rem;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            color: #64748b;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="brand-badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                    <span>UNAP &bull; SIU SUNEDU</span>
                </div>
                <h1 class="brand-title">Sistema de Postulantes</h1>
                <p class="brand-subtitle">Ingresa tus credenciales para acceder al módulo</p>
            </div>

            @if ($errors->any())
                <div class="alert-error" role="alert">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="flex-shrink:0; margin-top:1px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" id="form-login">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico Institucional</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        <input type="email" id="email" name="email" class="form-control" placeholder="usuario@unap.edu.pe" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </span>
                        <input type="password" id="password" name="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required autocomplete="current-password">
                        <button type="button" class="btn-toggle-pwd" onclick="togglePasswordVisibility()" title="Mostrar/ocultar contraseña" aria-label="Mostrar u ocultar contraseña">
                            <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" class="checkbox-input" {{ old('remember') ? 'checked' : '' }}>
                        <span>Recordar sesión</span>
                    </label>
                </div>

                <button type="submit" class="btn-submit" id="btn-submit">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                    <span>Acceder al Sistema</span>
                </button>
            </form>

            <div class="footer-note">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <span>Acceso restringido a personal autorizado OTI / Admisión</span>
            </div>
        </div>

        <div class="login-footer">
            &copy; {{ date('Y') }} Universidad Nacional del Altiplano de Puno &bull; Todos los derechos reservados.
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.innerHTML = '<path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path><line x1="2" y1="2" x2="22" y2="22"></line>';
            } else {
                pwd.type = 'password';
                icon.innerHTML = '<path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }

        document.getElementById('form-login').addEventListener('submit', function() {
            const btn = document.getElementById('btn-submit');
            btn.disabled = true;
            btn.style.opacity = '0.75';
            btn.innerHTML = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation: spin 1s linear infinite;"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg><span>Iniciando sesión...</span>';
        });
    </script>
</body>
</html>
