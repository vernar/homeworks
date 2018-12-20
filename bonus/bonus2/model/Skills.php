<?php

class Skills
{
    private $title;
    private $level;

    /**
     * Skills constructor.
     * @param $title
     * @param $level
     */
    public function __construct($title, $level)
    {
        $this->title = $title;
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }
}