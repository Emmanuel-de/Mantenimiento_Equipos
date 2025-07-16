<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tecno Plus Toys</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: #111;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        /* Contenedor principal */
        .container {
            position: relative;
            width: 380px;
            padding: 50px 40px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 20px;
            color: #fff;
            text-align: center;
            box-shadow: 0 0 20px rgba(255, 0, 102, 0.5), 0 0 40px rgba(0, 255, 255, 0.3);
        }

        .container::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            background: linear-gradient(45deg, #ff0066, #00ffff, #ff0066, #00ffff);
            background-size: 400% 400%;
            border-radius: 25px;
            filter: blur(10px);
            z-index: -1;
            animation: neonBorderAnimation 8s linear infinite;
        }

        @keyframes neonBorderAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Paleta de colores neón */
        .neon-palette {
            position: absolute;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
            z-index: 10;
        }

        .color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 0 10px currentColor;
        }

        .color-dot:hover {
            transform: scale(1.2);
            box-shadow: 0 0 15px currentColor;
        }

        .color-dot.pink { background: #ff0066; }
        .color-dot.cyan { background: #00ffff; }
        .color-dot.purple { background: #9d4edd; }
        .color-dot.green { background: #39ff14; }
        .color-dot.yellow { background: #ffff00; }
        .color-dot.orange { background: #ff6600; }

        /* Pestañas */
        .tabs {
            display: flex;
            margin-bottom: 30px;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            position: relative;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            background: transparent;
            border: none;
            color: #ccc;
            font-size: 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab.active {
            color: #ff0066;
        }

        .tab:hover:not(.active) {
            color: #fff;
        }

        /* Línea divisoria entre pestañas */
        .tab:first-child::after {
            content: '';
            position: absolute;
            top: 20%;
            right: 0;
            width: 2px;
            height: 60%;
            background: linear-gradient(to bottom, transparent, #ff0066, #00ffff, transparent);
            box-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
            animation: dividerPulse 2s ease-in-out infinite;
        }

        @keyframes dividerPulse {
            0%, 100% { 
                opacity: 0.7; 
                box-shadow: 0 0 8px rgba(255, 0, 102, 0.6);
            }
            50% { 
                opacity: 1; 
                box-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
            }
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
            color: #ccc;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            text-align: left;
        }

        .form-group input {
            width: 100%;
            padding: 15px;
            border: 2px solid #999;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #00ffff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            background: rgba(0, 0, 0, 0.7);
        }

        .form-group input::placeholder {
            color: #999;
        }

        /* Botones */
        .neon-button {
            width: 100%;
            padding: 15px;
            border: 2px solid transparent;
            border-radius: 10px;
            background: linear-gradient(45deg, #ff0066, #00ffff);
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
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff0066, #00ffff, #ff0066, #00ffff);
            background-size: 400% 400%;
            filter: blur(6px);
            border-radius: 12px;
            z-index: -1;
            animation: neonBorderAnimation 6s linear infinite;
        }

        .neon-button:hover {
            color: #000;
            background-color: #00ffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 255, 255, 0.4);
        }

        /* Links */
        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #ff0066;
            text-decoration: underline;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff;
        }

        /* Título */
        .title {
            margin-bottom: 5px;
            font-size: 32px;
            color: #00ffff;
            font-weight: bold;
            text-shadow: 0 0 5px #ff0066;
        }

        .subtitle {
            margin-bottom: 30px;
            font-style: italic;
            color: #ccc;
            font-size: 14px;
        }

        /* Mensajes de error */
        .error-message {
            background: rgba(255, 0, 102, 0.1);
            border: 1px solid #ff0066;
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
            color: #ff0066;
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
            background: rgba(0, 255, 255, 0.1);
            border: 1px solid #00ffff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            color: #00ffff;
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
            accent-color: #ff0066;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-size: 14px;
            cursor: pointer;
            color: #ccc;
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
            border-top: 3px solid #ff0066;
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
            
            .neon-palette {
                top: 10px;
                right: 10px;
                gap: 6px;
            }
            
            .color-dot {
                width: 10px;
                height: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Paleta de colores neón -->
        <div class="neon-palette">
            <div class="color-dot pink" onclick="changeTheme('pink')" title="Rosa Neón"></div>
            <div class="color-dot cyan" onclick="changeTheme('cyan')" title="Cian Neón"></div>
            <div class="color-dot purple" onclick="changeTheme('purple')" title="Púrpura Neón"></div>
            <div class="color-dot green" onclick="changeTheme('green')" title="Verde Neón"></div>
            <div class="color-dot yellow" onclick="changeTheme('yellow')" title="Amarillo Neón"></div>
            <div class="color-dot orange" onclick="changeTheme('orange')" title="Naranja Neón"></div>
        </div>

        <div class="title">TECNO PLUS TOYS</div>
        <div class="subtitle">PREVIENE. REPARA. OPTIMIZA</div>

        <div class="tabs">
            <button class="tab active" onclick="switchTab('login')">INICIAR SESIÓN</button>
            <button class="tab" onclick="switchTab('register')">REGISTRARSE</button>
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
                    <label for="email">EMAIL</label>
                    <input type="email" id="email" name="email" placeholder="Analizame@gmail.com" 
                           value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password">CONTRASEÑA</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">RECORDARME</label>
                </div>
                
                <button type="submit" class="neon-button">INICIAR SESIÓN</button>
                
                <a href="{{ route('password.request') }}" class="forgot-password">¿OLVIDASTE TU CONTRASEÑA?</a>
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
                    <label for="name">NOMBRE COMPLETO</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre completo" 
                           value="{{ old('name') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="email_register">EMAIL</label>
                    <input type="email" id="email_register" name="email" placeholder="Analizame@gmail.com" 
                           value="{{ old('email') }}" required>
                </div>
                
                <div class="form-group">
                    <label for="password_register">CONTRASEÑA</label>
                    <input type="password" id="password_register" name="password" placeholder="••••••••" required>
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">CONFIRMAR CONTRASEÑA</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                </div>
                
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">ACEPTO LOS TÉRMINOS Y CONDICIONES</label>
                </div>
                
                <button type="submit" class="neon-button">CREAR CUENTA</button>
            </form>
        </div>

        <!-- Indicador de carga -->
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>PROCESANDO...</p>
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

        function changeTheme(color) {
            const root = document.documentElement;
            const colorMap = {
                'pink': { primary: '#ff0066', secondary: '#ff3399' },
                'cyan': { primary: '#00ffff', secondary: '#66ffff' },
                'purple': { primary: '#9d4edd', secondary: '#c77dff' },
                'green': { primary: '#39ff14', secondary: '#7fff00' },
                'yellow': { primary: '#ffff00', secondary: '#ffff66' },
                'orange': { primary: '#ff6600', secondary: '#ff9933' }
            };
            
            const colors = colorMap[color];
            if (colors) {
                // Cambiar colores del título
                document.querySelector('.title').style.color = colors.primary;
                document.querySelector('.title').style.textShadow = `0 0 5px ${colors.secondary}`;
                
                // Cambiar colores de las pestañas activas
                document.querySelectorAll('.tab.active').forEach(tab => {
                    tab.style.color = colors.primary;
                });
                
                // Cambiar colores de los enlaces
                document.querySelectorAll('.forgot-password').forEach(link => {
                    link.style.color = colors.primary;
                });
                
                // Efecto visual en el punto seleccionado
                document.querySelectorAll('.color-dot').forEach(dot => {
                    dot.style.transform = 'scale(1)';
                    dot.style.border = '1px solid rgba(255, 255, 255, 0.3)';
                });
                
                const selectedDot = document.querySelector(`.color-dot.${color}`);
                if (selectedDot) {
                    selectedDot.style.transform = 'scale(1.3)';
                    selectedDot.style.border = '2px solid #fff';
                }
            }
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
                this.style.borderColor = '#ff0066';
                this.style.boxShadow = '0 0 20px rgba(255, 0, 102, 0.3)';
            } else {
                this.style.borderColor = '#999';
                this.style.boxShadow = 'none';
            }
        });
    </script>
</body>
</html>