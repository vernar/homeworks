<?php /** @see index.php */ ?>
<div id="header">
    <div id="menu">
        <?php foreach ($ldata as  $key => $value): ?>
            <div class="menuitem<?= $key == $_GET['p'] ? ' active' : ''  ?>" style="width:<?= 100/count($ldata)-5?>%">
                <a href="?p=<?= $key ?>" > <?=$value['shortname'] ?></a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
