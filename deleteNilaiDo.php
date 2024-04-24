<?php

$nim = $_GET['nim'];
$kode_mk = $_GET['kode_mk'];

$url = 'http://localhost/psait_uts/mahasiswa_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

echo '<script>';
echo 'alert("Status: ' . $result["status"] . '\\nMessage: ' . $result["message"] . '");';
echo 'window.location.href = "index.php";';
echo '</script>';
?>