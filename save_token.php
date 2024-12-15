<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];

    $cek = $connection->prepare('SELECT * FROM tokens_user WHERE token = ?');
    $cek->bind_param('s', $token);
    $cek->execute();
    $result = $cek->get_result();
    $data = $result->fetch_array();

    if (!$result) {
        $stmt = $connection->prepare('INSERT INTO tokens_user (token) VALUES (?) ON DUPLICATE KEY UPDATE token = ?');
        $stmt->bind_param('ss', $token, $token);
    } else {
        $stmt = $connection->prepare('UPDATE tokens_user SET token=? WHERE id=?');
        $stmt->bind_param('ss', $token, $data['id']);
    }

    if ($stmt->execute()) {
        echo json_encode([
            'status' => true,
            'message' => 'Token added successfully'
        ]);
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'Token not found'
        ]);
    }

    $stmt->close();
    $connection->close();
}
