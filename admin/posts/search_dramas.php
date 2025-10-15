<?php
require_once '../lib/db.php';
include '../lib/drama_lib.php';

$dramaObj = new Drama();

$q = trim($_GET['q'] ?? '');

if ($q === '') {
    echo json_encode([]);
    exit;
}

// Search in all dramas by title
$stmt = $dramaObj->db->prepare("
    SELECT id, title, featured_img, status
    FROM dramas
    WHERE title LIKE :search
    ORDER BY id DESC
");
$searchTerm = "%$q%";
$stmt->bindParam(':search', $searchTerm);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
