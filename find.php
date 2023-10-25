<?php
function cariKataDalamFile($kata, $direktori) {
    $result = array();

    // Buka direktori
    $dir = opendir($direktori);

    if ($dir) {
        while (false !== ($file = readdir($dir))) {
            if ($file != '.' && $file != '..') {
                $path = $direktori . '/' . $file;

                // Jika ini adalah direktori, rekursif mencari di dalamnya
                if (is_dir($path)) {
                    $result = array_merge($result, cariKataDalamFile($kata, $path));
                } elseif (is_file($path) && pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                    // Jika ini adalah file PHP, baca isi file
                    $content = file_get_contents($path);
                    if (strpos($content, $kata) !== false) {
                        $result[] = $path;
                    }
                }
            }
        }
        closedir($dir);
    }

    return $result;
}

if (isset($_GET['find']) && !empty($_GET['find'])) {
    $kataCari = $_GET['find'];
    $direktoriAwal = __DIR__; // Direktori awal di mana skrip PHP ini berada
    $hasilPencarian = cariKataDalamFile($kataCari, $direktoriAwal);

    if (isset($_GET['delete']) && !empty($_GET['delete'])) {
        $fileToDelete = $_GET['delete'];
        if (file_exists($fileToDelete) && is_file($fileToDelete) && pathinfo($fileToDelete, PATHINFO_EXTENSION) === 'php') {
            if (unlink($fileToDelete)) {
                echo "File '$fileToDelete' berhasil dihapus.";
            } else {
                echo "Gagal menghapus file '$fileToDelete'.";
            }
        } else {
            echo "File yang akan dihapus tidak valid.";
        }
    }

    if (empty($hasilPencarian)) {
        echo "Kata '$kataCari' tidak ditemukan dalam file-file PHP di direktori dan subdirektori.";
    } else {
        echo "Kata '$kataCari' ditemukan dalam file-file berikut:<br>";
        foreach ($hasilPencarian as $file) {
            echo "$file ";
            // Tambahkan tautan untuk menghapus file yang sesuai
            echo "<a href='?find=$kataCari&delete=" . urlencode($file) . "'>Hapus</a><br>";
        }
    }
} else {
    echo "Harap berikan parameter 'find' dengan kata yang ingin dicari, misalnya: index.php?find=upload";
}
?>