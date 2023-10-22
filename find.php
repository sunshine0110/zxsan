<?php
function searchWordInDirectory($directory, $word) {
    if (is_dir($directory)) {
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $path = $directory . '/' . $file;

                if (is_dir($path)) {
                    searchWordInDirectory($path, $word);
                } else {
                    // Cari kata dalam isi file
                    $fileContents = file_get_contents($path);
                    if (stripos($fileContents, $word) !== false) {
                        echo "Kata '$word' ditemukan dalam file: $path<br>";
                    }
                }
            }
        }
    }
}

if (isset($_GET['get'])) {
    $wordToSearch = $_GET['get'];
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    searchWordInDirectory($documentRoot, $wordToSearch);
}
?>
