<?php

include 'koneksi.php';
require_once 'vendor/autoload.php';

function getToken()
{
    $client = new Google_Client();
    $client->setAuthConfig('fcm-web-51531-firebase-adminsdk-xilce-80b9d2be6f.json');
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    return $client->getAccessToken()['access_token'];
}

function sendNotification($data)
{
    $token = getToken();
    $url = 'https://fcm.googleapis.com/v1/projects/fcm-web-51531/messages:send';
    $payload = json_encode(['message' => $data]);

    $headers = [
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];

    $sql = "INSERT INTO notifikasi (title, body) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $title, $body);

    if ($stmt->execute()) {
        $message = [];

        $queryToken = mysqli_query($connection, 'SELECT * FROM tokens_user');
        $listTokenUser = mysqli_fetch_all($queryToken, MYSQLI_ASSOC);

        foreach ($listTokenUser as $token) {
            $message[] = [
                'token' => $token['token'],
                'notification' => [
                    'title' => $title,
                    'body' => $body
                ]
            ];
        }

        foreach ($message as $msg) {
            $sendNotif = sendNotification($msg);
        }
    } else {
        echo "Gagal menambahkan notifikasi: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
