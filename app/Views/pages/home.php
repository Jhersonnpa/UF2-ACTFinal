<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gate</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
</head>
<body>

    <div id="index">

        <form action="<?= base_url() ?>/rebreFormulari" method="post">
        <?= csrf_field() ?>
            <?php
            $session = session();
            $codiU=isset($codiU)? $codiU:"";
            $msg=isset($session->msg)? $session->msg:"";
            echo $msg;
            ?>
            <h2>LOGIN</h2>
            <?php
            if (!empty($validation)) {
                if ($validation->getError('codiU')) {
                    echo $validation->getError('codiU');
                }    
            }
            ?>
            <input type="text" name="codiU" value="<?= $codiU ?>" placeholder="Codigo usuario">
            <?php
            if (!empty($validation)) {
                if ($validation->getError('password')) {
                    echo $validation->getError('password');
                }    
            }
            ?>
            <input type="password" name="password" placeholder="Contraseña">          

            <div>
            <input type="submit" value="Entra" name="submit">
            <a href="register">Registrate</a>
            </div>
        </form>
    </div>

</body>
</html>