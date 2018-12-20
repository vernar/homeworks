<?php

class Experiences
{
    private $job;
    private $dateFrom;
    private $dateTo;
    private $company;
    private $details;

    /**
     * Experiences constructor.
     * @param $job
     * @param $dateFrom
     * @param $dateTo
     * @param $company
     * @param $details
     */
    public function __construct($job, $dateFrom, $dateTo, $company, $details)
    {
        $this->job = $job;
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->company = $company;
        $this->details = $details;
    }

    /**
     * @return mixed
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @return mixed
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return mixed
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        return $this->details;
    }


}