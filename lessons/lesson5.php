<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        table.mult {
            border: 3px solid #000000;
            width: 50%;
            text-align: left;
            border-collapse: collapse;
        }
        table.mult td, table.mult th {
            border: 1px solid #000000;
            padding: 5px 4px;
        }
        table.mult tbody td {
            font-size: 16px;
        }
        table.mult tfoot td {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <table class="mult">
        <?php for($x=2; $x <= 10; $x++): ?>
        <tr>
            <?php for($y=2; $y < 10; $y++): ?>
            <td><?= $y . '*' . $x . '=' . $x*$y?></td>
            <?php endfor; ?>
        </tr>
        <?php endfor; ?>
    </table>
    <br />
    <?php $x = 2; ?>
    <?php while(true): ?>
        <p><?= $x . '^2=' . $result = $x * $x ?></p>
        <?php if ( $result  > 100 ) goto message; ?>
        <?php $x++ ?>
    <?php endwhile; ?>

    <?php message: echo 'Цикл завершён, ваше величество' ?>
</body>
</html>