<?php
// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $wish_message = trim($_POST['message'] ?? '');
    
    if (!empty($name) && !empty($wish_message)) {
        // Create db directory if it doesn't exist
        if (!is_dir('db')) {
            mkdir('db', 0777, true);
        }
        
        // Prepare wish data
        $wish = [
            'id' => time() . rand(1000, 9999),
            'name' => $name,
            'message' => $wish_message,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        
        // Load existing wishes
        $wishes = [];
        if (file_exists('db/wishes.txt')) {
            $existing_content = file_get_contents('db/wishes.txt');
            if (!empty($existing_content)) {
                $wishes = json_decode($existing_content, true) ?? [];
            }
        }
        
        // Add new wish to the beginning
        array_unshift($wishes, $wish);
        
        // Save wishes
        if (file_put_contents('db/wishes.txt', json_encode($wishes, JSON_PRETTY_PRINT))) {
            $message = '<div class="alert alert-success">Your birthday wish has been added! Thank you for your kind words.</div>';
        } else {
            $message = '<div class="alert alert-danger">Failed to save your wish. Please try again.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Please fill in both your name and message.</div>';
    }
}

// Load all wishes
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
    <title>Birthday Wishes - Aghni's Birthday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="wishes-container">
        <div class="container py-5">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="wishes-title">💌 harapan 💌</h1>
                <p class="wishes-subtitle">berikan harapan yang baik untuk aghni</p>
            </div>

            <!-- Wish Form -->
            <div class="wish-form-section mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="wish-form-card">
                            <h3 class="text-center mb-4">
                                <i class="fas fa-heart"></i> keluar dari kartu harapan
                            </h3>

                            <?php echo $message; ?>

                            <form method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Nama kamu</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter your name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="message" class="form-label">tulisin pesan kmu /label>
                                            <textarea class="form-control" id="message" name="message" rows="4"
                                                placeholder="Write your heartfelt birthday wish..." required></textarea>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-paper-plane"></i> kirim harapan mu ke aghni
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishes Display -->
            <div class="wishes-display">
                <div class="text-center mb-4">
                    <h2 class="wishes-count-title">
                        <i class="fas fa-heart text-danger"></i>
                        Birthday Wishes (<?php echo count($wishes); ?>)
                        <i class="fas fa-heart text-danger"></i>
                    </h2>
                </div>

                <?php if (empty($wishes)): ?>
                <div class="empty-wishes">
                    <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                    <h3>No Wishes Yet</h3>
                    <p class="text-muted">Be the first to leave a birthday message!</p>
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
                                <h5 class="wish-name"><?php echo htmlspecialchars($wish['name']); ?></h5>
                                <small class="wish-date">
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('M j, Y \a\t g:i A', strtotime($wish['timestamp'])); ?>
                                </small>
                            </div>
                        </div>
                        <div class="wish-content">
                            <p><?php echo nl2br(htmlspecialchars($wish['message'])); ?></p>
                        </div>
                        <div class="wish-footer">
                            <small class="text-muted">
                                <i class="fas fa-heart text-danger"></i> With love
                            </small>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Auto-resize textarea
    document.getElementById('message').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const message = document.getElementById('message').value.trim();

        if (!name || !message) {
            e.preventDefault();
            alert('Please fill in both your name and message.');
        }
    });
    </script>
</body>

</html>