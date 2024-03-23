<?php

namespace App\tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlaylistControllerTest extends WebTestCase
{
    
    public function testAccesPage()
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', '/playlists');
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatuscode());
    }

    public function testContenuPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/playlists');
        $this->assertSelectorTextContains('th', 'playlist');
        $this->assertCount(4, $crawler->filter('th'));
    }

    public function testLinkPlaylist()
    {
        $client = static::createClient();
        $crawler =  $client->request('GET', '/playlists');
        $link = $crawler->filter('a')->eq(8)->attr('href');
        $crawler = $client->request('GET',$link);
        $response = $client->getResponse();
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $uri = $client->getRequest()->server->get("REQUEST_URI");
        $this->assertEquals('/playlists/playlist/13', $uri); 
    }
    
    public function testFiltrePlaylist()
    {
        $client = static::createClient();
        $client->request('GET', '/playlists');
        $crawler = $client->submitForm('filtrer', [
            'recherche' => 'Cours'
        ]);
        $this->assertCount(22, $crawler->filter('h5'));
        $this->assertSelectorTextContains('h5', 'Cours Composant logiciel');
    }

    public function testSortPlaylist()
    {
        $client = static::createClient();
        $client->request('GET', '/playlists/tri/name/DESC');
        $this->assertSelectorTextContains('h5', 'Visual Studio 2019 et C#');
        $client->request('GET', '/playlists/tri/amount/ASC');
        $this->assertSelectorTextContains('h5', 'Cours Informatique embarquée');
        $client->request('GET', '/playlists/tri/amount/DESC');
        $this->assertSelectorTextContains('h5', 'Bases de la programmation (C#)');
    }
}