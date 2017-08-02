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
        self::assertEquals(200, $client->getResponse()->getStatusCode());
        //Only one good title
        self::assertEquals(1, $crawler->filter('h1')->count());
        //Title of application
        self::assertContains('G-Equip', $crawler->filter('h1')->text());

        //Menu verification
        self::assertContains('Home', $crawler->filter('#navbar-top li.active')->text());

        //User menu verification
        self::assertContains('Sign In', $crawler->filter('#navbar-top ul.navbar-right li.first')->text());
        self::assertContains('Sign Up', $crawler->filter('#navbar-top ul.navbar-right li.last')->text());
    }
}
