<?php

use App\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VerifDateTest extends KernelTestCase{
    
    public function testPublishedAtIsFutureDate()
    {
        $futureDate = new DateTime('+1 day');
        $formation = new Formation();
        $formation->setPublishedAt($futureDate);

        $this->assertTrue($formation->getPublishedAt() > new DateTime(), 'La date de publication doit être antérieure à la date actuelle.');
    }
}