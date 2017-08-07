<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Testing
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */
namespace AppBundle\Tests\Controller;

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
