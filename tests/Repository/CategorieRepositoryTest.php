<?php

namespace App\Tests\Validations\Repository;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManager;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

Class CategorieRepositoryTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function getRepository(): CategorieRepository
    {
        self::bootKernel();
        $repository = self::getContainer()->get(CategorieRepository::class);
        return $repository;
    }

    public function testnumCategorie()
    {
        $repository = $this->getRepository();
        $nbCategorie = $repository->count([]);
        $this->assertEquals( 9, $nbCategorie);
    }

    public function newCategorie() : Categorie
    {
        $categorie = (new Categorie())
            ->setName("test");
        return $categorie;
    }

    public function testAddCategorie()
    {
        $repository = $this->getRepository();
        $categorie = $this->newCategorie();
        $nbCategorie = $repository->count([]);

        $this->entityManager->persist($categorie);
        $this->entityManager->flush();
        $this->assertEquals($nbCategorie + 1, $repository->count([]), "Err");

    }

    public function testDelCategorie()
    {
        $repository = $this->getRepository();

        $nbCategorie = $repository->count([]);
        $categorie = $repository->findOneBy(['name' => "test"]);
        $categorie = $this->entityManager->merge($categorie);
        $this->entityManager->remove($categorie);
        $this->entityManager->flush();
        $this->assertEquals($nbCategorie - 1, $repository->count([]), "Err");
    }

}