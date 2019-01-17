<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Content</title>
</head>
<body style="background-color: <?= isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>">
<span><a href="<?= $siteurl?>index.php?action=logoutaction" > logout</a> </span>
<div>content</div>
</body>
</html>