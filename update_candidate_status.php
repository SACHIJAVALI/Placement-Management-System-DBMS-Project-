<?php
session_start();
require './src/Database.php';
$db = database::getinstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    // Update status in database
    $sql = "UPDATE applied_jobs SET status = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $result = $stmt->execute();

    if ($result) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>
