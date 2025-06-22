<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // Handle login
    if ($_POST['username'] ?? '' === 'admin' && $_POST['password'] ?? '' === 'aghni2025') {
        $_SESSION['admin_logged_in'] = true;
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $error = "Invalid credentials!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: dashboard.php');
    exit;
}

// Handle delete operations
if (isset($_SESSION['admin_logged_in'])) {
    if (isset($_GET['delete_image'])) {
        $image_to_delete = $_GET['delete_image'];
        $image_path = 'assets/img/' . basename($image_to_delete);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        header('Location: dashboard.php');
        exit;
    }
    
    if (isset($_GET['clear_wishes'])) {
        file_put_contents('db/wishes.txt', '');
        header('Location: dashboard.php');
        exit;
    }
}

// Get uploaded images
$images = [];
if (is_dir('assets/img')) {
    $image_files = glob('assets/img/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    foreach ($image_files as $image) {
        $images[] = basename($image);
    }
}

// Get wishes
$wishes = [];
if (file_exists('db/wishes.txt')) {
    $wishes_content = file_get_contents('db/wishes.txt');
    if (!empty($wishes_content)) {
        $wishes = json_decode($wishes_content, true) ?? [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Aghni's Birthday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php if (!isset($_SESSION['admin_logged_in'])): ?>
    <!-- Login Form -->
    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-6 col-lg-4">
                    <div class="login-card">
                        <div class="text-center mb-4">
                            <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                            <h2>Admin Dashboard</h2>
                            <p class="text-muted">Enter credentials to access dashboard</p>
                        </div>

                        <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <!-- demo usernaem: admin
                        demo password: aghni2025 -->

                        <div class="text-center mt-3">
                            <small class="text-muted">hanya untuk pemilik website monecruzz</small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <!-- Dashboard Content -->
    <?php include 'includes/header.php'; ?>

    <div class="dashboard-container">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h1 class="dashboard-title">🎛️ Admin Dashboard 🎛️</h1>
                        <a href="?logout=1" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stats-content">
                            <h3><?php echo count($images); ?></h3>
                            <p>Total Photos</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stats-content">
                            <h3><?php echo count($wishes); ?></h3>
                            <p>Birthday Wishes</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="dashboard-tabs">
                <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="photos-tab" data-bs-toggle="tab" data-bs-target="#photos"
                            type="button" role="tab">
                            <i class="fas fa-images"></i> Manage Photos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="wishes-tab" data-bs-toggle="tab" data-bs-target="#wishes"
                            type="button" role="tab">
                            <i class="fas fa-comments"></i> Manage Wishes
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="dashboardTabsContent">
                    <!-- Photos Tab -->
                    <div class="tab-pane fade show active" id="photos" role="tabpanel">
                        <div class="tab-header">
                            <h3>Photo Management</h3>
                            <a href="gallery.php" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Photo
                            </a>
                        </div>

                        <?php if (empty($images)): ?>
                        <div class="empty-state">
                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                            <p>No photos uploaded yet.</p>
                        </div>
                        <?php else: ?>
                        <div class="row g-3">
                            <?php foreach ($images as $image): ?>
                            <div class="col-md-4 col-lg-3">
                                <div class="photo-card">
                                    <img src="assets/img/<?php echo htmlspecialchars($image); ?>" alt="Photo"
                                        class="photo-thumbnail">
                                    <div class="photo-overlay">
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('<?php echo htmlspecialchars($image); ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="photo-info">
                                        <small><?php echo htmlspecialchars($image); ?></small>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Wishes Tab -->
                    <div class="tab-pane fade" id="wishes" role="tabpanel">
                        <div class="tab-header">
                            <h3>Wishes Management</h3>
                            <?php if (!empty($wishes)): ?>
                            <button class="btn btn-danger" onclick="confirmClearWishes()">
                                <i class="fas fa-trash"></i> Clear All Wishes
                            </button>
                            <?php endif; ?>
                        </div>

                        <?php if (empty($wishes)): ?>
                        <div class="empty-state">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p>No wishes submitted yet.</p>
                        </div>
                        <?php else: ?>
                        <div class="wishes-list">
                            <?php foreach ($wishes as $wish): ?>
                            <div class="wish-card">
                                <div class="wish-header">
                                    <div class="wish-avatar">
                                        <?php echo strtoupper(substr($wish['name'], 0, 1)); ?>
                                    </div>
                                    <div class="wish-meta">
                                        <h5><?php echo htmlspecialchars($wish['name']); ?></h5>
                                        <small
                                            class="text-muted"><?php echo date('M j, Y', strtotime($wish['timestamp'])); ?></small>
                                    </div>
                                </div>
                                <div class="wish-content">
                                    <p><?php echo nl2br(htmlspecialchars($wish['message'])); ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(image) {
        if (confirm('Are you sure you want to delete this image?')) {
            window.location.href = '?delete_image=' + encodeURIComponent(image);
        }
    }

    function confirmClearWishes() {
        if (confirm('Are you sure you want to clear all wishes? This action cannot be undone.')) {
            window.location.href = '?clear_wishes=1';
        }
    }
    </script>
</body>

</html>