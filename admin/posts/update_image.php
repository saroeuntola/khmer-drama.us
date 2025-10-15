<?php
session_start();
require_once '../lib/db.php';
require_once '../lib/drama_lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['featured_img'])) {
    $dramaId = $_POST['drama_id'];
    $file = $_FILES['featured_img'];

    $uploadDir = __DIR__ . '/../../images/';
    $originalName = basename($file['name']);
    $targetFile = $uploadDir . $originalName;
    $dbPath = 'images/' . $originalName; // Path to store in DB

    $dramaObj = new Drama();

    // Get current image from DB
    $stmt = $dramaObj->db->prepare("SELECT featured_img FROM dramas WHERE id = ?");
    $stmt->execute([$dramaId]);
    $oldImage = $stmt->fetchColumn();

    // Delete old image if exists and different from new
    if ($oldImage && file_exists('../' . $oldImage) && $oldImage !== $dbPath) {
        unlink('../' . $oldImage);
    }

    // Move uploaded file (will overwrite if name exists)
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $dramaObj->updateImage($dramaId, $dbPath); // Store path in DB
        header('Location: ./');
        exit;
    } else {
        echo "Failed to upload image.";
    }
}
