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
<form method="post" action="index.php?action=registeraction">
    <input type="hidden" name="action" value="registeraction" />
    <span>name</span>
    <input type="text" name="login" value="<?= isset($_POST['login']) ? $_POST['login'] : '' ?>" />
    <span>email</span>
    <input type="text" name="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" />
    <span>password</span>
    <input type="password" name="password" value="" />
    <input type="submit" title="submit" />
</form>
</body>
</html>