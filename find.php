<?php
function searchWordInDirectory($directory, $word, $maxResults = 10) {
    if (is_dir($directory)) {
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $path = $directory . '/' . $file;

                if (is_dir($path)) {
                    searchWordInDirectory($path, $word, $maxResults);
                } else {
                    // Cari kata dalam isi file
                    $fileContents = file_get_contents($path);
                    if (stripos($fileContents, $word) !== false) {
                        echo "Kata '$word' ditemukan dalam file: $path<br>";
                        $maxResults--;
                    }
                }

                if ($maxResults <= 0) {
                    break;
                }
            }
        }
    }
}

if (isset($_GET['get'])) {
    $wordToSearch = $_GET['get'];
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];

    // Batasi jumlah hasil yang ditampilkan
    $maxResults = 10;

    searchWordInDirectory($documentRoot, $wordToSearch, $maxResults);
} else {
    echo "Silakan berikan parameter 'get' dengan kata yang ingin Anda cari.";
}
?>
