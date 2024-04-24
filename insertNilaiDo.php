<?php

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $kode_mk = $_POST['kode_mk'];
    $nilai = $_POST['nilai'];

    $url = 'http://localhost/psait_uts/mahasiswa_api.php';
    $ch = curl_init($url);

    $jsonData = array(
        'nim' => $nim,
        'kode_mk' => $kode_mk,
        'nilai' => $nilai
    );

    $jsonDataEncoded = json_encode($jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $result = curl_exec($ch);
    $result = json_decode($result, true);

    curl_close($ch);

    echo '<script>';
    echo 'alert("Status: ' . $result["status"] . '\\nMessage: ' . $result["message"] . '");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
}
?>