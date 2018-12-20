<?php

class Person
{
    private $name;
    private $tagline;
    private $email;
    private $phone;
    private $website;
    private $summary;

    private $education = [];
    private $expirience = [];
    private $interest = [];
    private $language = [];
    private $projects = [];
    private $skills = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * @param mixed $tagline
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param Education $education
     */
    public function addEducation(Education $education)
    {
        $this->education[] = $education;
    }

    /**
     * @return array
     */
    public function getExpirience()
    {
        return $this->expirience;
    }

    /**
     * @param Experiences $expirience
     */
    public function addExpirience(Experiences $expirience)
    {
        $this->expirience[] = $expirience;
    }

    /**
     * @return array
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * @param Interest $interest
     */
    public function addInterest(Interest $interest)
    {
        $this->interest[] = $interest;
    }

    /**
     * @return array
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param Language $language
     */
    public function addLanguage(Language $language)
    {
        $this->language[] = $language;
    }

    /**
     * @return array
     */
    public function getProjects()
    {
        return $this->projects;
    }

    /**
     * @param Projects $projects
     */
    public function addProjects(Projects $projects)
    {
        $this->projects[] = $projects;
    }

    /**
     * @return array
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param Skills $skills
     */
    public function addSkills(Skills $skills)
    {
        $this->skills[] = $skills;
    }

}