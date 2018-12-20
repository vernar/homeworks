<?php

class Interest
{
    private $interests;

    /**
     * Interest constructor.
     * @param string $interests
     */
    public function __construct(string $interests)
    {
        $this->interests = $interests;
    }

    /**
     * @return string
     */
    public function getInterests()
    {
        return $this->interests;
    }
}