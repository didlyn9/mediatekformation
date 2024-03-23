<?php

use App\Entity\Formation;
use PHPUnit\Framework\TestCase;

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

class DateTest extends TestCase{
    
    public function testGetPublishedAtString()
    {
        $formation = new Formation();

        $datePublication = new DateTime('2022-01-01');
        $formation->setPublishedAt($datePublication);
        $datePublicationString = $formation->getPublishedAtString();
        $this->assertEquals('01/01/2022', $datePublicationString);
    }

    public function testGetPublishedAtStringWithNullDate()
    {
        $formation = new Formation();
        $datePublicationString = $formation->getPublishedAtString();
        $this->assertEquals('', $datePublicationString);
    }

}