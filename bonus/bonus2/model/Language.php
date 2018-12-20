<?php

class Language
{
    private $languageName;
    private $languageLevel;

    /**
     * Language constructor.
     * @param $languageName
     * @param $languageLevel
     */
    public function __construct($languageName, $languageLevel)
    {
        $this->languageName = $languageName;
        $this->languageLevel = $languageLevel;
    }

    /**
     * @return mixed
     */
    public function getLanguageName()
    {
        return $this->languageName;
    }

    /**
     * @return mixed
     */
    public function getLanguageLevel()
    {
        return $this->languageLevel;
    }
}