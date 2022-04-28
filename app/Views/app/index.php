<?php 
    $session = session();
    if ($session->logged_in == false) {
        $session->set('msg', 'No te has logueado');
        return redirect()->to('/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate - Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css')?>">
</head>
<body>
    
    <div class="nav">
        <nav>
            <a href="<?= base_url()?>/dashboard"><h2>Dashboard</h2></a>
            <ul>
                <li id="li-selected"><a href="<?= base_url()?>/dashboard">Visión General</a></li>
                <li id="logout"><a href="<?= base_url()?>/logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <div id="dashboard" class="contenedor">

        <div class="fitxers-personals card">
            <h2>Mis archivos</h2>
            <?php
            if (isset($data)) {
                foreach ($data as $key => $value) {
                    echo "
                    <div>
                        <img src='data:".$value['tipusF'].";base64,".base64_encode($value['contingut'])."'/>
                        <span>".$value['nomF']."</span>
                        <span>".$value['data']."</span>
                    </div>
                    ";
                }
                
            }
            ?>
            
            <form action="<?= base_url() ?>/upload" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <?php
                $file=isset($file)? $file:"";
                ?>

                <?php
                if (!empty($validation)) {
                    if ($validation->getError('file')) {
                        echo $validation->getError('file');
                    }    
                }
                ?>
                <label for="file">Subir archivo nuevo</label><br><br>
                <input type="file" name="file" id="file" value="<?= $file ?>"><br><br><br>
                <div>
                <input type="submit" value="Subir" name="upload">
                </div>
            </form>
        </div>
        <div class="archivosC card">
                <h2>Archivos compartidos</h2>
            </div>
            <div class="amigos card">   
                <h2>Amigos</h2>
            </div>
        <!-- <div class="fitxers-compartits">
            
        </div> -->
    </div>
</body>
</html>