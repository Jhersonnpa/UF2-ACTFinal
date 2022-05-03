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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
    <?php
            if (!empty($validation)) {
                if ($validation->getError('codiU')) {
                    echo $validation->getError('codiU');
                }    
            }
            ?>
        <div class="fitxers-personals card">
            <h2>Mis archivos</h2>
            <?php
            if (isset($data)) {
                echo $session->msg;
                $con = mysqli_connect("localhost","root","","uf2_afinal");
                echo "<div class='container-archives'>";
                if (isset($errors)) {
                    echo $errors->getError('file');
                }
                foreach ($data as $key => $value) {
                    $sql = "select * from usuaris";
                    $res=mysqli_query($con, $sql);
                    echo "
                    <div>
                        <img src='data:".$value['tipusF'].";base64,".base64_encode($value['contingut'])."'/>
                        <span>".$value['nomF']."</span>
                        <span>".$value['data']."</span>
                        <form action='".base_url()."/compartir' method='post'>
                        ".csrf_field()."
                            <input type='hidden' name='compartirF' value='".$value['codiF']."'>
                            <select name='compartirU'>";
                            while($fila = mysqli_fetch_assoc($res)){
                                echo "<option value='".$fila['codiU']."'>".$fila['codiU']."</option>";
                            }
                            echo "</select><button type='submit' name='compartir' class='share'><i class='bx bx-share-alt'></i></button>
                        </form>
                    </div>
                    ";
                }
                echo "</div>";
                mysqli_close($con);
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
                <?php 
                    if (isset($dataCompartir)) {
                        $con = mysqli_connect("localhost","root","","uf2_afinal");
                        
                        foreach ($dataCompartir as $key => $value) {
                            $sql="select * from fitxers f join compartir c on f.codiF = c.codiF where f.codiF = '".$value['codiF']."'";
                            $res=mysqli_query($con, $sql);
                            $fila = mysqli_fetch_assoc($res);

                            
                            echo "
                                <div>
                                    <img src='data:".$fila['tipusF'].";base64,".base64_encode($fila['contingut'])."'/>
                                    <span>".$fila['nomF']."</span>
                                    <span>".$fila['data']."</span>
                                </div>
                            ";
                            
                        }
                        mysqli_close($con);
                    }
                    else {
                        echo "Por el momento nadie ha compartido archivos.";
                    }
                ?>
            </div>
        <!-- <div class="fitxers-compartits">
            
        </div> -->
    </div>
</body>
</html>