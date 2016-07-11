<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiAirlineControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/airline/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /airline/");
        $crawler = $client->click($crawler->selectLink('Create a new Airline')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'fi_airline[name]'  => 'TestAirline',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("TestAirline")')->count(), 'Missing element td:contains("TestAirline")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fi_airline[name]'  => 'TestAirline2',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "TestAirline2"
        $this->assertGreaterThan(0, $crawler->filter('[value="TestAirline2"]')->count(), 'Missing element [value="TestAirline2"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/TestAirline2/', $client->getResponse()->getContent());
    }
}
