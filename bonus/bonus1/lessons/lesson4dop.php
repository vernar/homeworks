
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    </head>
    <body>
        <pre>
            <?php
            $getpostcompare = [
                'способ передачи данных - у get в строке запроса, у пост в шапке сообщения',
                'объём передаваемых данных у POST запроса больше',
                'в POST запросе возможно передача файлов',
                'POST запрос сложнее перехватить, данные скрыты в head ',
                'для GET запроса, возможно определять параметры прямо в строке браузера'
            ];
            print_r($getpostcompare);

            if(!empty($_POST)) {
                extract($_POST);
            } elseif(!empty($_GET)){
                extract($_GET);
            }
            ?>
        </pre>
        <p>Post Request</p>
        <form method="post" action="">
            <span>Имя: </span>
            <input type="text" name="firstname" />
            <span>Фамилия: </span>
            <input type="text" name="lastname" />
            <span>Возраст: </span>
            <input type="text" name="age" />
            <input type="submit" />
        </form>
        <p>Get Request</p>
        <form method="get" action="">
            <span>Имя: </span>
            <input type="text" name="firstname" />
            <span>Фамилия: </span>
            <input type="text" name="lastname" />
            <span>Возраст: </span>
            <input type="text" name="age" />
            <input type="submit" />
        </form>

    <p>
        <?php if( !(empty($_GET) && empty($_POST)) ): ?>
            <span>Привет, меня зовут <?= $firstname;?> <?= $lastname; ?>, мой возраст - <?= $age; ?>  </span>
        <?php endif; ?>
    </p>


    </body>
</html>