<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Your file was successfully uploaded!</h3>

<ul>
    <?php
    echo "
        $nomF - $tipusF - $data - $codiU
    ";
    ?>
</ul>

<p><?= anchor('upload', 'Upload Another File!') ?></p>
</body>
</html>