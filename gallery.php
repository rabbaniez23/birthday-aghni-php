<?php
// Handle file upload
$upload_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['photo'])) {
    $upload_dir = 'assets/img/';
    
    // Create directory if it doesn't exist
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file = $_FILES['photo'];
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    
    if (in_array($file_extension, $allowed_extensions)) {
        if ($file['size'] <= 5000000) { // 5MB limit
            $new_filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
            $upload_path = $upload_dir . $new_filename;
            
            if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                $upload_message = '<div class="alert alert-success">Photo uploaded successfully!</div>';
            } else {
                $upload_message = '<div class="alert alert-danger">Failed to upload photo.</div>';
            }
        } else {
            $upload_message = '<div class="alert alert-danger">File size too large. Maximum 5MB allowed.</div>';
        }
    } else {
        $upload_message = '<div class="alert alert-danger">Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.</div>';
    }
}

// Get all uploaded images
$images = [];
if (is_dir('assets/img')) {
    $image_files = glob('assets/img/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    foreach ($image_files as $image) {
        $images[] = [
            'filename' => basename($image),
            'path' => $image,
            'upload_time' => filemtime($image)
        ];
    }
    // Sort by upload time (newest first)
    usort($images, function($a, $b) {
        return $b['upload_time'] - $a['upload_time'];
    });
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery - Aghni's Birthday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'includes/header.php'; ?>

    <div class="gallery-container">
        <div class="container py-5">
            <!-- Header -->
            <div class="text-center mb-5">
                <h1 class="gallery-title">📸 kenanagan 📸</h1>
                <p class="gallery-subtitle">taroh foto kamu bersama aghni</p>
            </div>

            <!-- Upload Section -->
            <div class="upload-section mb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="upload-card">
                            <h3 class="text-center mb-4">
                                <i class="fas fa-cloud-upload-alt"></i> taro foto kmu dengan aghni
                            </h3>

                            <?php echo $upload_message; ?>

                            <form method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="photo" class="form-label">pilih foto</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*"
                                        required>
                                    <div class="form-text">Maximum file size: 5MB. Supported formats: JPG, JPEG, PNG,
                                        GIF</div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-upload"></i> Upload foto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php if (empty($images)): ?>
                <div class="empty-gallery">
                    <i class="fas fa-images fa-4x text-muted mb-3"></i>
                    <h3>No Photos Yet</h3>
                    <p class="text-muted">Upload your first photo to start the gallery!</p>
                </div>
                <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($images as $image): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageModal"
                            onclick="showImage('<?php echo htmlspecialchars($image['path']); ?>', '<?php echo htmlspecialchars($image['filename']); ?>')">
                            <img src="<?php echo htmlspecialchars($image['path']); ?>" alt="Gallery Image"
                                class="gallery-image">
                            <div class="gallery-overlay">
                                <i class="fas fa-search-plus"></i>
                            </div>
                            <div class="gallery-info">
                                <small>
                                    <i class="fas fa-calendar"></i>
                                    <?php echo date('M j, Y', $image['upload_time']); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalTitle">Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Full Size Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function showImage(imagePath, filename) {
        document.getElementById('modalImage').src = imagePath;
        document.getElementById('imageModalTitle').textContent = filename;
    }

    // Preview uploaded image
    document.getElementById('photo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // You can add preview functionality here if needed
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>