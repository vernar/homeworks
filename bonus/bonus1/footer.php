
<div id="footer-content">
    <?php /** @see index.php */ ?>
    <?php foreach ($cur['footerliks'] as  $key => $value): ?>
        <div class="menuitem" style="width:<?= 100/count($cur['footerliks'])-5?>%">
            <a href="<?= $value ?>"  target="_blank"> <?= $key ?></a>
        </div>
    <?php endforeach; ?>
</div>