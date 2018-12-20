<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<p><?= $_POST['tt']; ?></p>
<p><span>page 2</span></p>

<form action="test.php" method="post">
    <input type="text" name="tt">
    <input type="submit">
</form>
</body>
</html>