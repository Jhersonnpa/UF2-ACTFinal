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
    <li>name: <?= esc($uploaded_flleinfo->getBasename()) ?></li>
    <li>size: <?= esc($uploaded_flleinfo->getSizeByUnit('kb')) ?> KB</li>
    <li>extension: <?= esc($uploaded_flleinfo->guessExtension()) ?></li>
    <?= $writepath ?>
</ul>

<p><?= anchor('upload', 'Upload Another File!') ?></p>
</body>
</html>