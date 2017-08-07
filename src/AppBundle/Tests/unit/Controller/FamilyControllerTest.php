<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FamilyControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // @TODO We must be ROLE_ADMIN
        // https://stackoverflow.com/questions/27927454/how-to-simulate-authentication-via-hwioauth-in-a-symfony2-functional-test
        // http://gitnacho.github.io/symfony-docs-es/cookbook/testing/simulating_authentication.html
        $this->markTestSkipped('We must find a solution to be ROLE_ADMIN');

        // Create a new entry in the database
        $crawler = $client->request('GET', '/settings/family/');
        self::assertTrue($client->getResponse()->isSuccessful());

        $crawler = $client->click($crawler->selectLink('Create a new family')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_family[name]'  => 'Test',
            'parent' => 'Equipements dynamiques'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_family[name]'  => 'Foo',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }
}
