<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate - Subir archivo</title>
    <link rel="stylesheet" href="<?= base_url('css/dashboard.css')?>">
</head>
<body>
    <div class="nav">   
        <nav>
            <a href="<?= base_url()?>/dashboard"><h2>Dashboard</h2></a>
            <ul>
                <li><a href="<?= base_url()?>/dashboard">Visión General</a></li>
                <li id="li-selected"><a href="<?= base_url()?>/upload">Subir archivo</a></li>
                <li id="logout"><a href="<?= base_url()?>/logout">Cerrar sesión</a></li>
            </ul>
        </nav>
    </div>

    <div class="contenedor">
        <div>
            <form action="<?= base_url() ?>/rebreFormRegister" method="post">
                <h2>REGISTRO</h2>
                <?= csrf_field() ?>
                <?php
                $codiU=isset($codiU)? $codiU:"";
                $correu=isset($correu)? $correu:"";
                $password=isset($password)? $password:"";
                $passwordConfirm=isset($passwordConfirm)? $passwordConfirm:"";
                $telefon=isset($telefon)? $telefon:"";
                ?>

                <?php
                if (!empty($validation)) {
                    if ($validation->getError('codiU')) {
                        echo $validation->getError('codiU');
                    }    
                }
                ?>
                <input type="text" name="codiU" id="codiU" value="<?= $codiU ?>" placeholder="Codigo de Usuario (Máx 10 cáracteres)">
                <?php
                if (!empty($validation)) {
                    if ($validation->getError('correu')) {
                        echo $validation->getError('correu');
                    }    
                }
                ?>
                <input type="email" name="correu" value="<?= $correu ?>" placeholder="Correo">
                
                <?php
                if (!empty($validation)) {
                    if ($validation->getError('password')) {
                        echo $validation->getError('password');
                    }    
                }
                ?>
                <input type="password" name="password" value="<?= $password ?>" placeholder="Contraseña">
                
                <?php
                if (!empty($validation)) {
                    if ($validation->getError('passwordConfirm')) {
                        echo $validation->getError('passwordConfirm');
                    }    
                }
                    
                ?>
                <input type="password" name="passwordConfirm" value="<?= $passwordConfirm ?>" placeholder="Vuelve a introducir la contraseña">
                
                
                <?php
                if (!empty($validation)) {
                    if ($validation->getError('telefon')) {
                        echo $validation->getError('telefon');
                    }    
                }  
                ?>
                <input type="tel" name="telefon" value="<?= $telefon ?>" placeholder="Telefono">
                <?php
                if (!empty($validation)) {
                    if ($validation->getError('telefon')) {
                        echo $validation->getError('telefon');
                    }    
                }
                ?>
                <div>
                <input type="submit" value="Registrarse" name="registro">
                <a href="<?= base_url() ?>">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>