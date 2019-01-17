<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="post" action="<?= $siteurl ?>controllers/adminaction.php?action=checkaction">
        <input type="hidden" name="action" value="loginaction" />
        <span>login</span>
        <input type="text" name="login" value="<?= isset($_POST['login']) ?$_POST['login']: ''  ?>" />
        <span>password</span>
        <input type="password" name="password" value="" />
        <input type="submit" title="submit" />
    </form>

</body>
</html>