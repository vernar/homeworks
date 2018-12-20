<?php

class Projects
{
    private $title;
    private $url;
    private $descriptions;

    /**
     * Projects constructor.
     * @param $title
     * @param $url
     * @param $descriptions
     */
    public function __construct($title, $url, $descriptions)
    {
        $this->title = $title;
        $this->url = $url;
        $this->descriptions = $descriptions;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }




}