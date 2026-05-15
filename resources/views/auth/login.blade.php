<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smart-Catalog</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f0f0;
            margin: 0;
        }

        .login-wrap {
            width: 420px;
            background: linear-gradient(160deg, #f7374f 0%, #c2185b 45%, #88304e 100%);
            border-radius: 32px;
            padding: 48px 40px 44px;
            box-shadow: 0 24px 64px rgba(136, 48, 78, 0.35), 0 8px 24px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }

        /* decorative circles */
        .login-wrap::before {
            content: '';
            position: absolute;
            right: -50px; top: -50px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
        }
        .login-wrap::after {
            content: '';
            position: absolute;
            left: -30px; bottom: -60px;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 6px;
        }
        .login-logo i {
            font-size: 2rem;
            color: rgba(255,255,255,0.85);
        }

        .login-title {
            text-align: center;
            font-size: 2rem;
            font-weight: 300;
            color: rgba(255,255,255,0.95);
            letter-spacing: -0.5px;
            margin-bottom: 32px;
        }

        .login-label {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.75);
            font-weight: 500;
            margin-bottom: 8px;
            padding-left: 4px;
        }

        .login-input {
            width: 100%;
            height: 48px;
            background: rgba(255,255,255,0.88);
            border: none;
            border-radius: 50px;
            padding: 0 20px;
            font-size: 0.9rem;
            color: #333;
            outline: none;
            transition: background 0.2s, box-shadow 0.2s;
            margin-bottom: 20px;
        }
        .login-input:focus {
            background: rgba(255,255,255,0.98);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        }
        .login-input::placeholder { color: #aaa; }

        .login-remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.75);
            font-size: 0.82rem;
            margin-bottom: 28px;
        }
        .login-remember input[type=checkbox] { accent-color: white; width: 14px; height: 14px; }

        .login-btn {
            width: 100%;
            height: 50px;
            background: rgba(0,0,0,0.3);
            color: white;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .login-btn:hover {
            background: rgba(0,0,0,0.45);
            transform: translateY(-1px);
        }
        .login-btn:active { transform: translateY(0); }

        .login-footer {
            text-align: center;
            margin-top: 22px;
            font-size: 0.82rem;
            color: rgba(255,255,255,0.65);
        }
        .login-footer a {
            color: rgba(255,255,255,0.9);
            font-weight: 600;
            text-decoration: none;
        }
        .login-footer a:hover { text-decoration: underline; }

        .login-alert {
            background: rgba(0,0,0,0.2);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 0.82rem;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        .login-alert ul { margin-bottom: 0; padding-left: 16px; }
    </style>
</head>
<body>

    <div class="login-wrap">

        <div class="login-logo"><i class="fas fa-store"></i></div>
        <h1 class="login-title">sign in</h1>

        @if(session('sukses'))
            <div class="login-alert"><i class="fas fa-check-circle me-1"></i> {{ session('sukses') }}</div>
        @endif

        @if($errors->any())
            <div class="login-alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" autocomplete="off">
            @csrf

            <div class="login-label">Email Address</div>
            <input type="email" name="email" class="login-input" placeholder="admin@smartcatalog.com" required value="{{ old('email') }}">

            <div class="login-label">Password</div>
            <input type="password" name="password" class="login-input" placeholder="••••••••" required>

            <div class="login-remember">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="login-btn">Login</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>