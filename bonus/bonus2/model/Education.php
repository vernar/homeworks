<?php

class Education
{
    private $degree;
    private $meta;
    private $timeFrom;
    private $timeTo;

    /**
     * Education constructor.
     * @param $degree
     * @param $meta
     * @param $timeFrom
     * @param $timeTo
     */
    public function __construct($degree, $meta, $timeFrom, $timeTo)
    {
        $this->degree = $degree;
        $this->meta = $meta;
        $this->timeFrom = $timeFrom;
        $this->timeTo = $timeTo;
    }

    /**
     * @return mixed
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @return mixed
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * @return mixed
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

}