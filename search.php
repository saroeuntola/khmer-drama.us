<?php
include './admin/lib/db.php';
header('Content-Type: application/json');

$conn = dbConn();

$q = $_GET['q'] ?? '';
$q = trim($q);

if ($q === '') {
    echo json_encode([]);
    exit;
}

// Search in dramas table
$stmt = $conn->prepare("SELECT id, title, slug, featured_img FROM dramas WHERE title LIKE :search LIMIT 10");
$searchTerm = "%$q%";
$stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);

$stmt->execute();
$dramas = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($dramas);
