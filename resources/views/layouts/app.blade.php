<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPK TK Bunda Khodijah - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #343a40;
            --sidebar-active-bg: rgba(255, 255, 255, 0.2);
            --sidebar-color: rgba(255, 255, 255, 0.75);
            --sidebar-active-color: #fff;
            --content-padding: 2rem;
            --topbar-height: 60px;
        }
        
        body {
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--sidebar-bg);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 1rem;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar .nav-link {
            color: var(--sidebar-color);
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: 0.25rem;
            transition: all 0.2s;
        }
        
        .sidebar .nav-link:hover {
            color: var(--sidebar-active-color);
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: var(--sidebar-active-color);
            background-color: var(--sidebar-active-bg);
            font-weight: 500;
        }
        
        .sidebar .nav-link i {
            width: 1.5rem;
            text-align: center;
        }
        
        /* Top Admin Bar */
        .admin-bar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background-color: #f8f9fa;
            z-index: 900;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 var(--content-padding);
            border-bottom: 1px solid #dee2e6;
        }
        
        /* Main Content Area */
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: var(--content-padding);
            padding-top: calc(var(--topbar-height) + var(--content-padding));
            transition: all 0.3s;
        }
        
        .content-container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Mobile Menu Toggle Button */
        .mobile-menu-toggle {
            display: none;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--sidebar-color);
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 1rem;
            border-radius: 0.25rem;
            text-align: left;
        }
        
        .mobile-menu-toggle:hover {
            color: var(--sidebar-active-color);
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .mobile-menu-toggle i {
            transition: transform 0.3s;
        }
        
        .mobile-menu-toggle.collapsed i {
            transform: rotate(0deg);
        }
        
        .mobile-menu-toggle:not(.collapsed) i {
            transform: rotate(180deg);
        }
        
        /* Collapsible menu items for mobile */
        .mobile-menu-collapse {
            display: block !important;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -var(--sidebar-width);
            }
            
            .sidebar.active {
                margin-left: 0;
            }
            
            .admin-bar {
                left: 0;
            }
            
            .main-content {
                width: 100%;
                margin-left: 0;
                padding: 1rem;
                padding-top: calc(var(--topbar-height) + 1rem);
            }
            
            .main-content.active {
                margin-left: var(--sidebar-width);
                width: calc(100% - var(--sidebar-width));
            }
            
            .mobile-menu-toggle {
                display: block;
            }
            
            .sidebar-nav-items {
                display: none;
            }
            
            .sidebar.active .sidebar-nav-items {
                display: block;
            }
            
            /* Show only 3 menu items by default on mobile */
            .sidebar-nav-items.collapsible .nav-item:nth-child(n+4) {
                display: none;
            }
            
            .sidebar-nav-items.collapsible.show-all .nav-item {
                display: block !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-md-block" id="sidebar">
        <div class="d-flex flex-column h-100">
            <div class="mb-4 px-3">
                <h4 class="text-white text-center">TK Bunda Khodijah</h4>
                <hr class="text-white-50">
            </div>
            
            <!-- Mobile Menu Toggle Button -->
            <button class="mobile-menu-toggle d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenuCollapse" aria-expanded="false" aria-controls="mobileMenuCollapse">
                <i class="bi bi-chevron-down me-2"></i> Menu
            </button>
            
            <ul class="nav flex-column flex-grow-1 sidebar-nav-items collapsible" id="mobileMenuCollapse">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('siswas*') ? 'active' : '' }}" href="{{ route('siswas.index') }}">
                        <i class="bi bi-people me-2"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('programs*') ? 'active' : '' }}" href="{{ route('programs.index') }}">
                        <i class="bi bi-list-task me-2"></i> Program Kegiatan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('kriterias*') ? 'active' : '' }}" href="{{ route('kriterias.index') }}">
                        <i class="bi bi-clipboard-data me-2"></i> Kriteria Penilaian
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('nilais*') ? 'active' : '' }}" href="{{ route('nilais.index') }}">
                        <i class="bi bi-table me-2"></i> Nilai Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('keputusan*') ? 'active' : '' }}" href="{{ route('keputusan.index') }}">
                        <i class="bi bi-graph-up me-2"></i> Rekomendasi
                    </a>
                </li>
                
                <!-- Show More/Less Button for Mobile -->
                <li class="nav-item d-md-none text-center mt-2">
                    <button class="btn btn-sm btn-outline-light w-75" id="toggleMenuItems">
                        <i class="bi bi-chevron-down me-1"></i> Lebih Banyak
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- Admin Bar at Top Right -->
    <div class="admin-bar">
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle me-2"></i> Administrator
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                <li>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Mobile Toggle Button -->
        <button class="btn btn-primary d-md-none mb-3" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        
        <!-- Page Content -->
        <div class="content-container">
            <!-- Page Header -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('title')</h1>
                @hasSection('action-buttons')
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('action-buttons')
                    </div>
                @endif
            </div>
            
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <!-- Main Content -->
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
        
        // Auto close alerts after 5 seconds
        window.setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        // Toggle menu items for mobile
        const toggleMenuBtn = document.getElementById('toggleMenuItems');
        const menuItems = document.querySelector('.sidebar-nav-items.collapsible');
        let showAll = false;
        
        if (toggleMenuBtn && menuItems) {
            toggleMenuBtn.addEventListener('click', function() {
                showAll = !showAll;
                
                if (showAll) {
                    menuItems.classList.add('show-all');
                    this.innerHTML = '<i class="bi bi-chevron-up me-1"></i> Lebih Sedikit';
                } else {
                    menuItems.classList.remove('show-all');
                    this.innerHTML = '<i class="bi bi-chevron-down me-1"></i> Lebih Banyak';
                }
            });
        }
        
        // Close sidebar when clicking on a menu item in mobile view
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    document.getElementById('sidebar').classList.remove('active');
                    document.getElementById('main-content').classList.remove('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>