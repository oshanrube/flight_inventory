<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiAircraftControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/aircraft/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /aircraft/");
        $crawler = $client->click($crawler->selectLink('Create a new Aircraft')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'fi_aircraft[flightNumber]' => 'Flight123',
            'fi_aircraft[seatsCount]'   => '10',
            'fi_aircraft[idairline]'    => '1',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Flight123")')->count(), 'Missing element td:contains("Flight123")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fi_aircraft[flightNumber]' => 'Flight1234',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Flight1234"
        $this->assertGreaterThan(0, $crawler->filter('[value="Flight1234"]')->count(), 'Missing element [value="Flight1234"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Flight1234/', $client->getResponse()->getContent());
    }
}
