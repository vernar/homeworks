<?php

class Human {
    private $weight;
    private $height;
    private $name;
    private $lastname;

    public function __construct(string $name, string $lastName, int $weight, int $height)
    {
        $this->name = $name;
        $this->lastname = $lastName;
        $this->weight = $weight;
        $this->height = $height;
        Nation::increasePopulation(1);
    }

    public function __destruct()
    {
        Nation::decreasePopulation(1);
    }

    public function init(string $name, string $lastName, int $weight, int $height) {
        $this->name = $name;
        $this->lastname = $lastName;
        $this->weight = $weight;
        $this->height = $height;
    }

    public function getFullName(){
        return $this->name . ' ' . $this->lastname;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

}

class Nation {
    private $population = [];
    private static $allPopulation = 0;

    public function addHuman(Human $human){
        $objectHash = spl_object_hash($human);
        $this->population[$objectHash] = $human;
    }

    public function removeHuman(Human $human){
        $objectHash = spl_object_hash($human);
        unset($this->population[$objectHash]);
        self::decreasePopulation(1);
    }

    public function getFullInfo(Human $human){
        return
            "Полное имя: " .  $human->getFullName() .
            " Вес: " . $human->getWeight() .
            " Рост: " . $human->getHeight() . PHP_EOL;
    }

    public static function increasePopulation(int $count = 1){
        self::$allPopulation += $count;
    }

    public static function decreasePopulation(int $count = 1){
        self::$allPopulation -= $count;

    }

    public function getAllInfoAboutPopulation(){
        $messageInfo = '';
        $messageInfo .= 'Общее колличество человек в базе: ' . self::$allPopulation . PHP_EOL;
        foreach ($this->population as $human){
            $messageInfo .= $this->getFullInfo($human);
        }
        return nl2br($messageInfo);
    }

}

$humans[0] = new Human('Vasia', 'Pupkin', 70, 170);
$humans[1] = new Human('Petia', 'Rutow', 85, 185);
$humans[2] = new Human('Yura', 'Kotov', 55, 160);
$humans[3] = new Human('Fedia', 'Lisin', 83, 183);
$humans[4] = new Human('Vova', 'Pavlov', 85, 183);
$humans[5] = new Human('Valia', 'Kulicova', 71, 180);

$nation = new Nation();
foreach ($humans as $human){
    $nation->addHuman($human);
}

echo $nation->getAllInfoAboutPopulation();
