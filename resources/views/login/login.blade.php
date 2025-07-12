<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Neón</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #0c0c0c, #1a1a2e, #16213e);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Efectos de fondo animados */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .neon-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            animation: float 6s ease-in-out infinite;
        }

        .neon-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, #ff006e, #8338ec);
            top: 20%;
            left: 10%;
            box-shadow: 0 0 30px #ff006e, 0 0 60px #ff006e;
            animation-delay: 0s;
        }

        .neon-circle:nth-child(2) {
            width: 120px;
            height: 120px;
            background: linear-gradient(45deg, #06ffa5, #00d4ff);
            top: 60%;
            left: 80%;
            box-shadow: 0 0 40px #06ffa5, 0 0 80px #06ffa5;
            animation-delay: 2s;
        }

        .neon-circle:nth-child(3) {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #ffbe0b, #fb8500);
            top: 80%;
            left: 20%;
            box-shadow: 0 0 25px #ffbe0b, 0 0 50px #ffbe0b;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Contenedor principal */
        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff006e, #8338ec, #06ffa5, #00d4ff, #ffbe0b);
            border-radius: 20px;
            z-index: -1;
            animation: borderGlow 3s linear infinite;
        }

        @keyframes borderGlow {
            0% { filter: hue-rotate(0deg); }
            100% { filter: hue-rotate(360deg); }
        }

        /* Pestañas */
        .tabs {
            display: flex;
            margin-bottom: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab.active {
            color: #fff;
            background: linear-gradient(45deg, #ff006e, #8338ec);
            box-shadow: 0 0 20px rgba(255, 0, 110, 0.5);
        }

        .tab:hover:not(.active) {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        /* Formularios */
        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff006e;
            box-shadow: 0 0 20px rgba(255, 0, 110, 0.3);
            background: rgba(255, 255, 255, 0.1);
        }

        .form-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Botones */
        .neon-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(45deg, #ff006e, #8338ec);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .neon-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .neon-button:hover::before {
            left: 100%;
        }

        .neon-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(255, 0, 110, 0.4);
        }

        /* Links */
        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #06ffa5;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #fff;
            text-shadow: 0 0 10px #06ffa5;
        }

        /* Título */
        .title {
            text-align: center;
            color: #fff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 0 20px rgba(255, 0, 110, 0.5);
        }

        .subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Mensajes de error */
        .error-message {
            background: rgba(255, 68, 68, 0.1);
            border: 1px solid #ff4444;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            animation: slideIn 0.3s ease-out;
        }

        .error-message ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-message li {
            color: #ff6b6b;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .error-message li:last-child {
            margin-bottom: 0;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Mensajes de éxito */
        .success-message {
            background: rgba(6, 255, 165, 0.1);
            border: 1px solid #06ffa5;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #06ffa5;
            font-size: 14px;
            animation: slideIn 0.3s ease-out;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
            transform: scale(1.2);
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-size: 14px;
            cursor: pointer;
        }

        /* Efectos de carga */
        .loading {
            display: none;
            text-align: center;
            color: #fff;
            margin-top: 20px;
        }

        .spinner {
            width: 30px;
            height: 30px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid #ff006e;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                width: 90%;
                padding: 30px 20px;
            }
            
            .title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="bg-animation">
        <div class="neon-circle"></div>
        <div class="neon-circle"></div>
        <div class="neon-circle"></div>
    </div>

    <div class="container">
        <div class="title">SISTEMA NEÓN</div>
        <div class="subtitle">Bienvenido al futuro</div>

        <div class="tabs">
            <button class="tab active" onclick="switchTab('login')">Iniciar Sesión</button>
            <button class="tab" onclick="switchTab('register')">Registrarse</button>
        </div>

        <!-- Formulario de Login -->
        <div id="login-form" class="form-container {{ session('active_tab') == 'register' ? '' : 'active' }}">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Mostrar errores -->
                @if ($errors->any() && !session('active_tab'))
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="tu@email.com" 
                           value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recordarme</label>
                </div>
                
                <button type="submit" class="neon-button">Iniciar Sesión</button>
                
                <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </form>
        </div>

        <!-- Formulario de Registro -->
        <div id="register-form" class="form-container {{ session('active_tab') == 'register' ? 'active' : '' }}">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <!-- Mostrar errores -->
                @if ($errors->any() && session('active_tab') == 'register')
                    <div class="error-message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre completo" 
                           value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email_register">Email</label>
                    <input type="email" id="email_register" name="email" placeholder="tu@email.com" 
                           value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password_register">Contraseña</label>
                    <input type="password" id="password_register" name="password" placeholder="••••••••" required>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Acepto los términos y condiciones</label>
                </div>
                
                <button type="submit" class="neon-button">Crear Cuenta</button>
            </form>
        </div>

        <!-- Indicador de carga -->
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Procesando...</p>
        </div>
    </div>

    <script>
        function switchTab(tab) {
            // Cambiar pestañas activas
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.form-container').forEach(f => f.classList.remove('active'));
            
            // Activar pestaña seleccionada
            event.target.classList.add('active');
            document.getElementById(tab + '-form').classList.add('active');
        }

        function showLoading(form) {
            // Mostrar indicador de carga
            document.getElementById('loading').style.display = 'block';
            
            // Opcional: Ocultar formulario
            document.querySelectorAll('.form-container').forEach(f => f.style.display = 'none');
            
            // En una aplicación real, esto se manejaría con AJAX
            // Por ahora, solo mostramos el efecto visual
            setTimeout(() => {
                document.getElementById('loading').style.display = 'none';
                document.querySelectorAll('.form-container').forEach(f => f.style.display = 'block');
            }, 2000);
        }

        // Efectos adicionales para inputs
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Validación en tiempo real
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password_register').value;
            const confirmation = this.value;
            
            if (password !== confirmation && confirmation.length > 0) {
                this.style.borderColor = '#ff4444';
                this.style.boxShadow = '0 0 20px rgba(255, 68, 68, 0.3)';
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.1)';
                this.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>