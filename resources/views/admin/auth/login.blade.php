<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Shozy App</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            /* Shozy App Color Scheme - Matching Mobile App */
            --primary-color: #FF7F27;           /* Vibrant Orange - Main accent */
            --primary-dark: #E66A1A;            /* Darker orange for hover states */
            --primary-light: #FF9F5A;           /* Lighter orange for subtle accents */
            --header-bg: #F8F5F0;               /* Light beige/off-white - Header background */
            --content-bg: #FFFFFF;              /* Pure white - Content areas */
            --dark-color: #4A4A4A;              /* Dark grey - Main text */
            --secondary-color: #AAAAAA;         /* Light grey - Secondary text */
            --success-color: #4CAF50;           /* Vibrant green - Success, checkmarks */
            --warning-color: #FF9800;           /* Orange - Warnings */
            --danger-color: #F44336;            /* Red - Errors, delete actions */
            --accent-blue: #00BCD4;             /* Light blue/cyan - Diamond tier */
            --border-color: #E2E8F0;            /* Light grey - Borders */
            --shadow: 0 4px 20px rgba(74, 74, 74, 0.1);
            --shadow-lg: 0 10px 40px rgba(74, 74, 74, 0.15);
            --shadow-orange: 0 8px 25px rgba(255, 127, 39, 0.3);
        }

        body {
            background: linear-gradient(135deg, var(--header-bg) 0%, #F0EDE8 50%, #FFFFFF 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            overflow: hidden;
        }

        html {
            overflow: hidden;
        }

        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            overflow: hidden;
        }

        .login-card {
            background: var(--content-bg);
            border-radius: 24px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            width: 100%;
            max-width: 420px;
            max-height: 90vh;
            border: none;
            position: relative;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-blue) 100%);
        }

        .login-header {
            background: linear-gradient(135deg, var(--header-bg) 0%, #F0EDE8 100%);
            color: var(--dark-color);
            padding: 50px 25px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 1px solid var(--border-color);
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 127, 39, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .brand-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* margin-bottom: 20px; */
            margin-top: -56px;
            justify-content: center;
        }

        .brand-logo img {
            height: 122px;
            width: auto;
            margin-bottom: 15px;
            border-radius: 12px;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); */
            transition: transform 0.3s ease;
        }

        .brand-logo img:hover {
            transform: scale(1.05);
        }

        .brand-logo span {
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 0 2px 4px rgba(255, 127, 39, 0.2);
        }

        .brand-subtitle {
            font-size: 1rem;
            color: var(--secondary-color);
            font-weight: 500;
        }

        .login-body {
            padding: 40px 25px;
            background: var(--content-bg);
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 14px 20px 14px 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--content-bg);
            height: 50px;
            line-height: 1.2;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 127, 39, 0.25);
            background: var(--content-bg);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            left: 18px;
            top: 71%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            font-size: 1.1rem;
            transition: color 0.3s ease;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control:focus + .input-icon {
            color: var(--primary-color);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            border-radius: 16px;
            padding: 14px 25px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            height: 50px;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-orange);
        }

        .btn-login:active {
            transform: translateY(-1px);
        }

        .btn-login:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        .alert {
            border-radius: 16px;
            border: none;
            padding: 16px 20px;
            margin-bottom: 24px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1) 0%, rgba(76, 175, 80, 0.05) 100%);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(244, 67, 54, 0.1) 0%, rgba(244, 67, 54, 0.05) 100%);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .login-footer {
            text-align: center;
            padding: 20px 25px;
            background: var(--header-bg);
            color: var(--secondary-color);
            font-size: 0.85rem;
            border-top: 1px solid var(--border-color);
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            color: var(--primary-dark);
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .shape {
            position: absolute;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-blue));
            border-radius: 50%;
            opacity: 0.08;
            animation: float-shape 8s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float-shape {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 10px;
            }
            
            .login-card {
                margin: 10px;
                border-radius: 20px;
            }
            
            .login-header {
                padding: 45px 20px;
            }
            
            .login-body {
                padding: 35px 20px;
            }
            
            .brand-logo img {
                height: 80px;
                margin-bottom: 12px;
            }
            
            .brand-logo span {
                font-size: 1.8rem;
            }
        }

        .form-check {
            margin: 20px 0;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 127, 39, 0.25);
        }

        .form-check-label {
            color: var(--secondary-color);
            font-size: 0.85rem;
        }

        /* Enhanced animations */
        .form-control {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .form-control:nth-child(1) { animation-delay: 0.1s; }
        .form-control:nth-child(2) { animation-delay: 0.2s; }
        .form-control:nth-child(3) { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom checkbox styling */
        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: scale(1.1);
        }

        /* Enhanced button states */
        .btn-login:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 127, 39, 0.25);
        }

        /* Loading state enhancement */
        .btn-loading {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .spinner-border-sm {
            border-color: rgba(255, 255, 255, 0.3);
            border-right-color: white;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="card login-card">
            <div class="login-header">
                <div class="brand-logo">
                    <img src="{{ asset('assets/logo.png') }}" alt="Shozy App Logo" class="login-logo me-2">
                    {{-- <span>Shozy App</span> --}}
                </div>
                <div class="brand-subtitle">Admin Panel</div>
            </div>

            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        @foreach($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login') }}" id="loginForm">
                    @csrf
                    
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Enter your email"
                               required 
                               autofocus>
                        <i class="fas fa-envelope input-icon"></i>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Enter your password"
                               required>
                        <i class="fas fa-lock input-icon"></i>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-login" id="loginBtn">
                        <span class="btn-text">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </span>
                        <span class="btn-loading d-none">
                            <span class="spinner-border spinner-border-sm me-2" role="status"></span>
                            Signing In...
                        </span>
                    </button>
                </form>
            </div>

            <div class="login-footer">
                <p class="mb-0">
                    Secure access to Shozy App administration panel
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const btn = document.getElementById('loginBtn');
            const btnText = btn.querySelector('.btn-text');
            const btnLoading = btn.querySelector('.btn-loading');
            
            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            btn.disabled = true;
        });

        // Enhanced form animations
        const formElements = document.querySelectorAll('.form-control, .form-check, .btn-login');
        formElements.forEach((element, index) => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'all 0.6s ease-out';
            
            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * 100);
        });
    </script>
</body>
</html>
