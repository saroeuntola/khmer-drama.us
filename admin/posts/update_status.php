<?php
require_once '../lib/db.php';
require_once '../lib/drama_lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $dramaObj = new Drama();
    $id = $_POST['id'];

    // Get current status
    $stmt = $dramaObj->db->prepare("SELECT status FROM dramas WHERE id = ?");
    $stmt->execute([$id]);
    $currentStatus = $stmt->fetchColumn();

    // Toggle: 0 -> 1, 1 -> 0
    $newStatus = $currentStatus ? 0 : 1;

    // Update
    $stmt = $dramaObj->db->prepare("UPDATE dramas SET status = ? WHERE id = ?");
    $success = $stmt->execute([$newStatus, $id]);

    echo json_encode(['success' => $success, 'status' => $newStatus]);
    exit;
}
