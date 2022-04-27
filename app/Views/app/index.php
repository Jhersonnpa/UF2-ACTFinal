<?php 
    $session = session();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css')?>">
</head>
<body>
    
    <div class="nav">
        <nav>
            <h2>Dashboard</h2>
            <ul>
                <li><a href="">home</a></li>
                <li><a href="">stats</a></li>
                <li><a href="">admin</a></li>
                <li><a href="<?= base_url()?>/logout">logout</a></li>
            </ul>
        </nav>
    </div>

    <div id="dashboard">
        <h1><?= "Bienvenido, ".$session->get('correu') ?></h1>
        <div class="fitxers-personals">
            <h2>Mis archivos</h2>
            <?php
            if (isset($data)) {
                foreach ($data as $key => $value) {
                    echo "
                    <div>
                        <img src='data:".$value['tipusF'].";base64,".base64_encode( $value['contingut'] )."'/>
                        <span>".$value['nomF']."</span>
                        <span>".$value['data']."</span>
                    </div>
                    ";
                }
                
            }
            ?>
        </div>
    </div>
</body>
</html>