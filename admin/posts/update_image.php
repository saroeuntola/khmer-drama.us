<?php
session_start();
require_once '../lib/db.php';
require_once '../lib/drama_lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['featured_img'])) {
    $dramaId = $_POST['drama_id'];
    $file = $_FILES['featured_img'];

    $uploadDir = __DIR__ . '/../../images/';

    // Make sure upload folder exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Generate a unique filename to avoid conflicts
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $uniqueName = uniqid('drama_') . '.' . ($ext ?: 'jpg');
    $targetFile = $uploadDir . $uniqueName;
    $dbPath = 'images/' . $uniqueName; // Path to store in DB

    $dramaObj = new Drama();

    // Get current image from DB
    $stmt = $dramaObj->db->prepare("SELECT featured_img FROM dramas WHERE id = ?");
    $stmt->execute([$dramaId]);
    $oldImage = $stmt->fetchColumn();

    // Delete old image if exists
    if ($oldImage && file_exists(__DIR__ . '/../../' . $oldImage)) {
        unlink(__DIR__ . '/../../' . $oldImage);
    }

    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Update DB with new image path
        $dramaObj->updateImage($dramaId, $dbPath);
        header('Location: ./');
        exit;
    } else {
        echo "⚠️ Failed to upload image.";
    }
}
