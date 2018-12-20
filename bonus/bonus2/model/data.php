<?php

require __DIR__ . '/Education.php';
require __DIR__ . '/Experiences.php';
require __DIR__ . '/Interest.php';
require __DIR__ . '/Language.php';
require __DIR__ . '/Projects.php';
require __DIR__ . '/Skills.php';

require __DIR__ . '/Person.php';
$arrayData = require __DIR__ . '/../data/main.php';


$person = new Person();

$person->setName($arrayData['name']);
$person->setTagline($arrayData['tagline']);
$person->setEmail($arrayData['email']);
$person->setPhone($arrayData['phone']);
$person->setWebsite($arrayData['website']);
$person->setSummary($arrayData['summary']);

foreach ($arrayData['education'] as $item) {
    $person->addEducation(new Education(
        $item['degree'],
        $item['meta'],
        $item['time-from'],
        $item['time-to']
    ));
}

foreach ($arrayData['language'] as $languageName => $level) {
    $person->addLanguage(new Language($languageName, $level));
}
foreach ($arrayData['interests'] as $item) {
    $person->addInterest(new Interest($item));
}
foreach ($arrayData['experiences'] as $item) {
    $person->addExpirience(new Experiences(
        $item['job'],
        $item['dateFrom'],
        $item['dateTo'],
        $item['company'],
        $item['details']
    ));
}

foreach ($arrayData['projects'] as $item) {
    $person->addProjects(new Projects(
        $item['title'],
        $item['url'],
        $item['description']
    ));
}

foreach ($arrayData['skills'] as $item) {
    $person->addSkills(new Skills(
        $item['title'],
        $item['level']
    ));
}