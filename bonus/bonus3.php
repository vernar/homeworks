<?php
$anonim = new class {
    private $privateVariable;

    public function __set($name, $value)
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }

    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        } else {
            echo 'Свойство не определено' . PHP_EOL;
        }
        return null;
    }
};

//echo $anonim->privateVariable;
//$anonim->privateVariable = 'hello world' . PHP_EOL;
//echo $anonim->privateVariable;

