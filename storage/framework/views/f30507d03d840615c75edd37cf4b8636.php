<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo $__env->yieldContent('title', 'Admin Panel'); ?> - <?php echo e(config('app.name', 'Laravel')); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    .btn-outline-primary:hover {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }
    
    .form-control, .form-select {
        background-color: #333 !important;
        border-color: #555 !important;
        color: #e9e9e9 !important;
    }
    
    .form-control:focus, .form-select:focus {
        background-color: #333 !important;
        border-color: #0d6efd !important;
        color: #e9e9e9 !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }
    
    .form-label {
        color: #e9e9e9 !important;
    }
    
    .text-muted {
        color: #adb5bd !important;
    }
    
    
    <!-- Custom Admin Styles -->
    <style>
        :root {
            --admin-dark: #0a0a0a;
            --admin-dark-light: #1a1a1a;
            --admin-dark-lighter: #2a2a2a;
            --admin-dark-border: #333;
            --admin-text: #e9e9e9;
            --admin-text-muted: #a0a0a0;
            --admin-primary: #3b82f6;
            --admin-primary-hover: #2563eb;
            --admin-success: #10b981;
            --admin-warning: #f59e0b;
            --admin-danger: #ef4444;
            --admin-info: #06b6d4;
            --admin-sidebar-width: 280px;
            --admin-sidebar-collapsed: 70px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-dark);
            color: var(--admin-text);
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--admin-sidebar-width);
            background: linear-gradient(180deg, var(--admin-dark-light) 0%, var(--admin-dark) 100%);
            border-right: 1px solid var(--admin-dark-border);
            transition: all 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }
        
        .admin-sidebar.collapsed {
            width: var(--admin-sidebar-collapsed);
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid var(--admin-dark-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--admin-text);
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .sidebar-logo i {
            width: 32px;
            height: 32px;
            background: var(--admin-primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--admin-text-muted);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }
        
        .sidebar-toggle:hover {
            background: var(--admin-dark-lighter);
            color: var(--admin-text);
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-section {
            margin-bottom: 1.5rem;
        }
        
        .nav-section-title {
            padding: 0 1rem;
            margin-bottom: 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--admin-text-muted);
        }
        
        .nav-item {
            margin: 0.25rem 0.75rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--admin-text-muted);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .nav-link:hover,
        .nav-link.active {
            background: var(--admin-primary);
            color: white;
            transform: translateX(2px);
        }
        
        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        /* Main Content */
        .admin-main {
            margin-left: var(--admin-sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        .admin-main.expanded {
            margin-left: var(--admin-sidebar-collapsed);
        }
        
        /* Header */
        .admin-header {
            background: var(--admin-dark-light);
            border-bottom: 1px solid var(--admin-dark-border);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--admin-text);
            margin: 0;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .header-btn {
            background: none;
            border: 1px solid var(--admin-dark-border);
            color: var(--admin-text);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .header-btn:hover {
            background: var(--admin-dark-lighter);
            border-color: var(--admin-primary);
            color: var(--admin-text);
        }
        
        .header-btn.primary {
            background: var(--admin-primary);
            border-color: var(--admin-primary);
            color: white;
        }
        
        .header-btn.primary:hover {
            background: var(--admin-primary-hover);
            color: white;
        }
        
        /* Content Area */
        .admin-content {
            padding: 2rem;
        }
        
        /* Cards */
        .admin-card {
            background: var(--admin-dark-light);
            border: 1px solid var(--admin-dark-border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.2s ease;
        }
        
        .admin-card:hover {
            border-color: var(--admin-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--admin-dark-border);
        }
        
        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--admin-text);
            margin: 0;
        }
        
        .card-subtitle {
            color: var(--admin-text-muted);
            font-size: 0.875rem;
            margin: 0.25rem 0 0 0;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, var(--admin-dark-light) 0%, var(--admin-dark-lighter) 100%);
            border: 1px solid var(--admin-dark-border);
            border-radius: 12px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--stat-color, var(--admin-primary));
        }
        
        .stat-card.success::before { background: var(--admin-success); }
        .stat-card.warning::before { background: var(--admin-warning); }
        .stat-card.danger::before { background: var(--admin-danger); }
        .stat-card.info::before { background: var(--admin-info); }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: white;
        }
        
        .stat-icon.success { background: var(--admin-success); }
        .stat-icon.warning { background: var(--admin-warning); }
        .stat-icon.danger { background: var(--admin-danger); }
        .stat-icon.info { background: var(--admin-info); }
        .stat-icon.primary { background: var(--admin-primary); }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--admin-text);
            line-height: 1;
        }
        
        .stat-label {
            color: var(--admin-text-muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.5rem;
            font-size: 0.75rem;
        }
        
        .stat-change.positive { color: var(--admin-success); }
        .stat-change.negative { color: var(--admin-danger); }
        
        /* Tables */
        .admin-table {
            background: var(--admin-dark-light);
            border: 1px solid var(--admin-dark-border);
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--admin-dark-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .table {
            margin: 0;
            color: var(--admin-text);
        }
        
        .table thead th {
            background: var(--admin-dark-lighter);
            border-color: var(--admin-dark-border);
            color: var(--admin-text);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }
        
        .table tbody td {
            border-color: var(--admin-dark-border);
            padding: 1rem;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background: var(--admin-dark-lighter);
        }
        
        /* Buttons */
        .btn-admin {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-admin-primary {
            background: var(--admin-primary);
            color: white;
        }
        
        .btn-admin-primary:hover {
            background: var(--admin-primary-hover);
            color: white;
        }
        
        .btn-admin-success {
            background: var(--admin-success);
            color: white;
        }
        
        .btn-admin-warning {
            background: var(--admin-warning);
            color: white;
        }
        
        .btn-admin-danger {
            background: var(--admin-danger);
            color: white;
        }
        
        .btn-admin-outline {
            background: transparent;
            border: 1px solid var(--admin-dark-border);
            color: var(--admin-text);
        }
        
        .btn-admin-outline:hover {
            background: var(--admin-dark-lighter);
            color: var(--admin-text);
        }
        
        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--admin-text);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            background: var(--admin-dark-lighter);
            border: 1px solid var(--admin-dark-border);
            border-radius: 6px;
            color: var(--admin-text);
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-control::placeholder {
            color: var(--admin-text-muted);
        }
        
        /* Badges */
        .badge-admin {
            padding: 0.25rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .badge-success {
            background: rgba(16, 185, 129, 0.2);
            color: var(--admin-success);
        }
        
        .badge-warning {
            background: rgba(245, 158, 11, 0.2);
            color: var(--admin-warning);
        }
        
        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: var(--admin-danger);
        }
        
        .badge-info {
            background: rgba(6, 182, 212, 0.2);
            color: var(--admin-info);
        }
        
        .badge-primary {
            background: rgba(59, 130, 246, 0.2);
            color: var(--admin-primary);
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            
            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .admin-header {
                padding: 1rem;
            }
            
            .admin-content {
                padding: 1rem;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar-logo span {
                display: none;
            }
            
            .nav-section-title {
                display: none;
            }
            
            .nav-link span {
                display: none;
            }
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--admin-dark);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--admin-dark-border);
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--admin-primary);
        }

        /* Bootstrap overrides */
        .card {
            background: var(--admin-dark-light) !important;
            border: 1px solid var(--admin-dark-border) !important;
            border-radius: 12px !important;
        }

        .card-header {
            background: var(--admin-dark-lighter) !important;
            border-bottom: 1px solid var(--admin-dark-border) !important;
            color: var(--admin-text) !important;
        }

        .btn-primary {
            background: var(--admin-primary) !important;
            border-color: var(--admin-primary) !important;
        }

        .btn-primary:hover {
            background: var(--admin-primary-hover) !important;
            border-color: var(--admin-primary-hover) !important;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.2) !important;
            border-color: var(--admin-success) !important;
            color: var(--admin-success) !important;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2) !important;
            border-color: var(--admin-danger) !important;
            color: var(--admin-danger) !important;
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-logo">
                <i class="fas fa-spa"></i>
                <span>Admin Panel</span>
            </a>
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Content</div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.services.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.services.*') ? 'active' : ''); ?>">
                        <i class="fas fa-heart"></i>
                        <span>Services</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.events.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.events.*') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Events & Workshops</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.blogs.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.blogs.*') ? 'active' : ''); ?>">
                        <i class="fas fa-blog"></i>
                        <span>Blog Posts</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.guides.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.guides.*') ? 'active' : ''); ?>">
                        <i class="fas fa-book"></i>
                        <span>Guides</span>
                    </a>
                </div>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">Management</div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.appointments.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.appointments.*') ? 'active' : ''); ?>">
                        <i class="fas fa-calendar-check"></i>
                        <span>Appointments</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.event-applications.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.event-applications.*') ? 'active' : ''); ?>">
                        <i class="fas fa-user-plus"></i>
                        <span>Event Applications</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.guide-downloads.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.guide-downloads.*') ? 'active' : ''); ?>">
                        <i class="fas fa-download"></i>
                        <span>Guide Downloads</span>
                    </a>
                </div>
            </div>
            
            <div class="nav-section">
                <div class="nav-section-title">System</div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.settings')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings') ? 'active' : ''); ?>">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="<?php echo e(route('admin.change-password')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.change-password') ? 'active' : ''); ?>">
                        <i class="fas fa-key"></i>
                        <span>Change Password</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    
    <!-- Main Content -->
    <div class="admin-main" id="adminMain">
        <!-- Header -->
        <header class="admin-header">
            <h1 class="header-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h1>
            <div class="header-actions">
                <a href="<?php echo e(url('/')); ?>" class="header-btn" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Site</span>
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="header-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>
        
        <!-- Content -->
        <main class="admin-content">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Admin JS -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('adminSidebar');
            const main = document.getElementById('adminMain');
            
            sidebar.classList.toggle('collapsed');
            main.classList.toggle('expanded');
            
            // Store state in localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
        
        // Restore sidebar state
        window.addEventListener('load', function() {
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                document.getElementById('adminSidebar').classList.add('collapsed');
                document.getElementById('adminMain').classList.add('expanded');
            }
        });
        
        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            document.getElementById('adminSidebar').classList.toggle('mobile-open');
        }
        
        // Auto-hide mobile sidebar on link click
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    document.getElementById('adminSidebar').classList.remove('mobile-open');
                }
            });
        });
        
        // Add mobile toggle button for small screens
        if (window.innerWidth <= 768) {
            const headerActions = document.querySelector('.header-actions');
            const mobileToggle = document.createElement('button');
            mobileToggle.className = 'header-btn me-2';
            mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
            mobileToggle.onclick = toggleMobileSidebar;
            headerActions.insertBefore(mobileToggle, headerActions.firstChild);
        }
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\client-fiverr\coaching\resources\views/layouts/admin.blade.php ENDPATH**/ ?>