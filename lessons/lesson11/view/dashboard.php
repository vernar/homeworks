<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.minimalistBlack {
          border: 3px solid #000000;
          width: 100%;
          text-align: left;
          border-collapse: collapse;
        }
        table.minimalistBlack td, table.minimalistBlack th {
          border: 1px solid #000000;
          padding: 5px 4px;
        }
        table.minimalistBlack tbody td {
          font-size: 13px;
        }
        table.minimalistBlack tfoot td {
          font-size: 14px;
        }
        .messages{
            color: red;
        }
    </style>
    <title>Dashboard</title>

</head>
<header>
    <a href="<?= $siteurl ?>controllers/adminaction.php?action=logoutaction" >logout</a>
    <span> User name: <?= $_SESSION['name']?></span>
    <span> User role: <?= $_SESSION['role'] == DBResource::ROLE_ADMIN ? 'admin' : 'moderator'?></span>
</header>
<body>
<form method="post" action="controllers/adminaction.php">
    <input type="hidden" name="action" value="deleteimage" />
    <button type="submit" style="color: red;">X</button>
</form>
<img class="profile" src="assets/images/profile.jpg<?= '?' . mt_rand(100,999) ?>" height="150" style="border-radius: 80px;" onerror="this.src ='assets/images/default.png'" />
<form enctype="multipart/form-data" action="controllers/adminaction.php" method="post">
    <input type="hidden" name="action" value="changeimage" />
    Upload new image: <input name="file" type="file" />
    <input name="submit" type="submit" value="Submit File" />
</form>
<table class="minimalistBlack">
    <tbody>
    <?php foreach ($connection->getAllComments() as $comment): ?>
    <tr>
        <td><?= $comment['comment_id'] ?> </td>
        <td><?= $comment['name'] ?> </td>
        <td><?= $comment['comment'] ?> </td>
        <td><?= $comment['date_submit'] ?> </td>
        <td>
            <form method="post" action="<?= $siteurl ?>controllers/adminaction.php" >
                <input type="hidden" name="action" value="changecommentstatus" />
                <input type="hidden" name="comment_id" value="<?= $comment['comment_id'] ?>" />
                <select name="status[]" onchange="this.form.submit()" >
                    <option <?= DBResource::COMMENT_NEW == $comment['status'] ? 'selected' : '' ?> value="<?= DBResource::COMMENT_NEW ?>">NEW</option>
                    <option <?= DBResource::COMMENT_APPROVED == $comment['status'] ? 'selected' : '' ?> value="<?= DBResource::COMMENT_APPROVED ?>">APPROVED</option>
                    <option <?= DBResource::COMMENT_DECLINED == $comment['status'] ? 'selected' : '' ?> value="<?= DBResource::COMMENT_DECLINED ?>">DECLINED</option>
                </select>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<h3>preview</h3>
<table class="minimalistBlack">
    <tbody>
    <?php foreach ($connection->getComments() as $comment): ?>
    <tr>
        <td><?= $comment['comment_id'] ?> </td>
        <td><?= $comment['name'] ?> </td>
        <td><?= $comment['comment'] ?> </td>
        <td><?= $comment['date_submit'] ?> </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="messages" >
    <?php
    if (isset($_SESSION['message'])){
    foreach ($_SESSION['message'] as $message){
        echo '<p>' . $message . '</p>';
    }
    $_SESSION['message'] = [];
}

    ?>
</div>
</body>
</html>