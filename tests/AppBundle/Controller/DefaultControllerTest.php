<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * Homepage tests
     */
    public function testIndex()
    {
        //Client creation
        $client = static::createClient();

        //We request home page
        $crawler = $client->request('GET', '/');

        //Good status code :)
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //Only one good title
        $this->assertEquals(1, $crawler->filter('h1')->count());
        //Title of application
        $this->assertContains('G-Equip', $crawler->filter('h1')->text());

        //Menu verification
        $this->assertContains('Home', $crawler->filter('#navbar-top li.active')->text());

        //User menu verification
        $this->assertContains('Sign In', $crawler->filter('#navbar-top ul.navbar-right li.first')->text());
        $this->assertContains('Sign Up', $crawler->filter('#navbar-top ul.navbar-right li.last')->text());
    }
}
