<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM voiture WHERE id_voiture = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $voiture = $result->fetch_assoc();
    
    header('Content-Type: application/json');
    echo json_encode($voiture);
}
?>