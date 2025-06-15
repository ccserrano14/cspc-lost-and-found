<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #fff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            padding: 1rem;
            z-index: 1000;
        }
        .sidebar-header {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }
        .sidebar-nav a {
            color: #333;
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar-nav a:hover {
            background: #f8f9fa;
            color: #2563eb;
        }
        .sidebar-nav a.active {
            background: #2563eb;
            color: #fff;
        }
        .sidebar-nav i {
            margin-right: 0.5rem;
            width: 20px;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
        }
        .stat-card {
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
            color: #fff;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .bg-pending { background: #f59e0b; }
        .bg-claimed { background: #10b981; }
        .bg-total { background: #2563eb; }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-bottom: 1rem;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <nav class="sidebar-nav">
            <li>
                <a href="<?= site_url('dashboard') ?>" class="active">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="<?= site_url('items') ?>">
                    <i class="bi bi-box-seam"></i>
                    Item Management
                </a>
            </li>
        </nav>
    </div>

    <div class="main-content">
        <h1>Dashboard Overview</h1>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card bg-total">
                    <i class="bi bi-collection fs-1"></i>
                    <h3><?= $totalItems ?? 0 ?></h3>
                    <p>Total Items</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-pending">
                    <i class="bi bi-hourglass-split fs-1"></i>
                    <h3><?= $pendingCount ?? 0 ?></h3>
                    <p>Pending Items</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card bg-claimed">
                    <i class="bi bi-check-circle fs-1"></i>
                    <h3><?= $claimedCount ?? 0 ?></h3>
                    <p>Claimed Items</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
