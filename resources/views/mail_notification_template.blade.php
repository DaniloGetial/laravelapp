<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirma tu correo</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #e0f2fe, #f0f9ff);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #0c4a6e;
        }
        
        .container {
            max-width: 600px;
            margin: 20px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .header {
            padding: 40px 20px;
            text-align: center;
            background: linear-gradient(135deg, rgba(56, 182, 255, 0.2), rgba(14, 165, 233, 0.3));
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
            animation: rotate 15s linear infinite;
            z-index: 0;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .header-content {
            position: relative;
            z-index: 1;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        
        .content {
            padding: 40px;
        }
        
        .message {
            margin-bottom: 30px;
            line-height: 1.7;
            color: #334155;
        }
        
        .btn-container {
            text-align: center;
            margin: 40px 0;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #0ea5e9, #38b6ff);
            color: white;
            text-decoration: none;
            padding: 16px 40px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #38b6ff, #0ea5e9);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }
        
        .btn:hover::before {
            opacity: 1;
        }
        
        .link-box {
            background: rgba(241, 245, 249, 0.5);
            border-radius: 12px;
            padding: 15px;
            margin-top: 20px;
            word-break: break-all;
            font-size: 13px;
            color: #64748b;
            border: 1px dashed #cbd5e1;
        }
        
        .footer {
            text-align: center;
            padding: 30px;
            color: #64748b;
            font-size: 13px;
            border-top: 1px solid rgba(203, 213, 225, 0.3);
        }
        
        @media (max-width: 640px) {
            body {
                display: block;
                padding: 20px 0;
            }
            
            .container {
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-content">
                <h1>¡Ya casi terminas, {{ $user->name }}!</h1>
            </div>
        </div>
        
        <div class="content">
            <div class="message">
                <p>Estamos emocionados de tenerte en {{ config('app.name') }}. Para comenzar, necesitamos que confirmes que esta es tu dirección de correo electrónico.</p>
                
                <p>Haz clic en el botón de abajo para verificar tu cuenta:</p>
            </div>
            
            <div class="btn-container">
                <a href="{{ url('/users/active/account/'.$token) }}" class="btn">Verificar mi correo</a>
            </div>
            
            <div class="message">
                <p>Si el botón no funciona, copia y pega este enlace en tu navegador:</p>
                <div class="link-box">
                    {{ url('/users/active/account/'.$token) }}
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>Si no reconoces esta actividad, por favor ignora este mensaje.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>