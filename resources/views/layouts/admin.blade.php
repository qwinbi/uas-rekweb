<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - {{ config('app.name') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #2c3e50;
            --sidebar-color: #ecf0f1;
            --sidebar-active: #34495e;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f6fa;
            min-height: 100vh;
        }
        
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            left: 0;
            top: 0;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0,0,0,0.2);
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 12px 20px;
            color: var(--sidebar-color);
            display: block;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        #sidebar ul li a:hover {
            background: var(--sidebar-active);
            color: white;
        }
        
        #sidebar ul li.active > a {
            background: var(--sidebar-active);
            color: white;
        }
        
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        #content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .navbar-admin {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 1rem 1.5rem;
        }
        
        .main-content {
            padding: 2rem;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .stat-card {
            border-radius: 15px;
            padding: 1.5rem;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .stat-card .icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .stat-card.primary { background: linear-gradient(135deg, #4361ee, #3a0ca3); }
        .stat-card.success { background: linear-gradient(135deg, #4caf50, #2e7d32); }
        .stat-card.warning { background: linear-gradient(135deg, #ff9800, #ef6c00); }
        .stat-card.danger { background: linear-gradient(135deg, #f44336, #c62828); }
        
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -var(--sidebar-width);
            }
            
            #content {
                margin-left: 0;
                width: 100%;
            }
            
            #sidebar.active {
                margin-left: 0;
            }
            
            #content.active {
                margin-left: var(--sidebar-width);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h4 class="text-white">
                <i class="fas fa-cog me-2"></i>
                Admin Panel
            </h4>
        </div>
        
        <ul class="list-unstyled components">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="{{ request()->is('admin/products*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="fas fa-box"></i>
                    Products
                </a>
            </li>
            
            <li class="{{ request()->is('admin/transactions*') ? 'active' : '' }}">
                <a href="{{ route('transactions.index') }}">
                    <i class="fas fa-exchange-alt"></i>
                    Transactions
                </a>
            </li>
            
            <li>
                <a href="#settingsSubmenu" data-bs-toggle="collapse" class="dropdown-toggle">
                    <i class="fas fa-cogs"></i>
                    Settings
                </a>
                <ul class="collapse list-unstyled" id="settingsSubmenu">
                    <li class="{{ request()->is('settings/logo') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.logo') }}">
                            <i class="fas fa-image"></i> Logo
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/settings/footer') ? 'active' : '' }}">
                        <a href="{{ route('settings.footer') }}">
                            <i class="fas fa-window-maximize"></i> Footer
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/settings/about') ? 'active' : '' }}">
                        <a href="{{ route('settings.about') }}">
                            <i class="fas fa-info-circle"></i> About
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/settings/qris') ? 'active' : '' }}">
                        <a href="{{ route('settings.qris') }}">
                            <i class="fas fa-qrcode"></i> QRIS
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="mt-4">
                <a href="{{ url('/') }}" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    View Website
                </a>
            </li>
            
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-start text-white w-100 ps-3 py-2">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar-admin">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary d-md-none">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="ms-auto">
                    <span class="me-3 text-muted">
                        <i class="fas fa-user-circle me-1"></i>
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Sidebar toggle
        document.getElementById('sidebarCollapse').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
        
        // SweetAlert notifications
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000
            });
        @endif
    </script>
    
    @stack('scripts')
</body>
</html>