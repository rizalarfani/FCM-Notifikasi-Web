<?php
if (connection_aborted()) {
    header('Connection: close');
    exit();
}

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');

include 'koneksi.php';

function sendData($id, $data)
{
    echo "id: " . $id . "\n";
    echo "data: " . $data;
    echo "\n\n";
    ob_flush();
    flush();
}

while (!connection_aborted()) {
    $query = mysqli_query($connection, 'SELECT * FROM notifikasi');
    $listNotifikasi = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if ($listNotifikasi) {
        sendData(time(), json_encode($listNotifikasi));
    }
    sleep(5);
}
