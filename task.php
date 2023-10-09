<?php

function listProcesses($start, $pageSize) {
    exec("ps aux", $output);
    $processes = array_slice($output, 1); 
    return array_slice($processes, $start, $pageSize);
}

function killProcess($pid) {
    exec("kill $pid");
}

$start = isset($_GET["start"]) ? (int)$_GET["start"] : 0;
$pageSize = isset($_GET["pageSize"]) ? (int)$_GET["pageSize"] : 10;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kill"])) {
    $pid_to_kill = $_POST["kill"];
    killProcess($pid_to_kill);
}

$processes = listProcesses($start, $pageSize);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <table id="process-table">
        <tr>
            <th>PID</th>
            <th>User</th>
            <th>CPU</th>
            <th>Memory</th>
            <th>Command</th>
            <th>Action</th>
        </tr>
        <?php foreach ($processes as $process) : ?>
            <?php $process_info = preg_split('/\s+/', $process); ?>
            <tr>
                <td><?= $process_info[1] ?></td>
                <td><?= $process_info[0] ?></td>
                <td><?= $process_info[2] ?></td>
                <td><?= $process_info[3] ?></td>
                <td><?= $process_info[10] ?></td>
                <td>
                    <form method="post" class="kill-form">
                        <input type="hidden" name="kill" value="<?= $process_info[1] ?>">
                        <input type="submit" value="Kill">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
    function refreshProcesses() {
        $.ajax({
            url: '<?= $_SERVER['PHP_SELF'] ?>?start=<?= $start ?>&pageSize=<?= $pageSize ?>',
            type: 'GET',
            success: function (data) {
                $('#process-table').html(data); // Hanya perbarui konten tabel
            }
        });
    }

    $('.kill-form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(),
            success: function () {
                refreshProcesses();
            }
        });
    });

    // Memuat data proses pertama kali
    refreshProcesses();
    </script>
</body>
</html>
