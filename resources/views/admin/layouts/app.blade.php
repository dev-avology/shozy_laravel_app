<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Shozy App</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 70px;
            --header-height: 70px;
            
            /* Colors */
            --primary-color: #FF7F27;
            --primary-dark: #E66A1A;
            --secondary-color: #6C757D;
            --success-color: #28A745;
            --warning-color: #FFC107;
            --danger-color: #DC3545;
            --info-color: #17A2B8;
            --light-color: #F8F9FA;
            --dark-color: #343A40;
            
            /* Backgrounds */
            --sidebar-bg: #FFFFFF;
            --header-bg: #FFFFFF;
            --content-bg: #F8F9FA;
            
            /* Borders and Shadows */
            --border-color: #E9ECEF;
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-medium: rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--content-bg);
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #FFFFFF 0%, #FAFAFA 100%);
            color: var(--dark-color);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            border-right: 1px solid #E2E8F0;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-header {
            padding: 0rem 1.5rem;
            background: linear-gradient(135deg, #F8F5F0 0%, #F0EDE8 100%);
            border-bottom: 1px solid #E2E8F0;
            text-align: center;
            min-height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 127, 39, 0.05) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .sidebar-logo {
            height: 102px;
            width: auto;
            object-fit: contain;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-bottom: 0.5rem;
            /* box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); */
            position: relative;
            z-index: 2;
        }

        .sidebar-logo:hover {
            transform: scale(1.05) translateY(-2px);
            /* box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); */
        }

        .sidebar-brand:hover {
            color: var(--primary-dark);
        }

        .sidebar-nav {
            padding: 1.5rem 0.5rem;
        }

        .nav-item {
            margin: 0.125rem 0;
        }

                .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: #4A4A4A;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0.125rem 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: var(--primary-color);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, rgba(255, 127, 39, 0.08) 0%, rgba(255, 127, 39, 0.04) 100%);
            color: var(--primary-color);
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(255, 127, 39, 0.15);
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--primary-color) 0%, #E66A1A 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 127, 39, 0.3);
            transform: translateX(8px);
        }

        .nav-link.active::before {
            transform: scaleY(1);
            background: white;
        }

        .nav-link i {
            width: 22px;
            margin-right: 0.875rem;
            text-align: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }

        .nav-link.active i {
            transform: scale(1.1);
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        .sidebar.collapsed .sidebar-brand {
            font-size: 1.2rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--content-bg);
            transition: margin-left 0.3s ease;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .content {
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
        }

        /* Header Styles */
        .header {
            background: var(--header-bg);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px var(--shadow-light);
        }

        .header h1 {
            margin: 0;
            color: var(--dark-color);
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Card Styles */
        .card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px var(--shadow-light);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 8px var(--shadow-medium);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Button Styles */
        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Form Styles */
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid var(--border-color);
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 127, 39, 0.25);
        }
        

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--secondary-color);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-menu {
            position: relative;
        }

        .user-button {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            color: var(--secondary-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-button:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }

            .sidebar-header {
                padding: 0rem 1.5rem;
                min-height: 100px;
            }

            .sidebar-logo {
                height: 65px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 1.25rem;
            }
        }

        /* Utilities */
        .text-primary { color: var(--primary-color) !important; }
        .text-success { color: var(--success-color) !important; }
        .text-warning { color: var(--warning-color) !important; }
        .text-danger { color: var(--danger-color) !important; }
        .text-info { color: var(--info-color) !important; }

        .bg-primary { background-color: var(--primary-color) !important; }
        .bg-success { background-color: var(--success-color) !important; }
        .bg-warning { background-color: var(--warning-color) !important; }
        .bg-danger { background-color: var(--danger-color) !important; }
        .bg-info { background-color: var(--info-color) !important; }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.05);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 127, 39, 0.3);
            border-radius: 3px;
            transition: background 0.3s ease;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 127, 39, 0.5);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Header -->
        @include('admin.layouts.header')

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('admin.layouts.footer')
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    @stack('scripts')
</body>
</html>
