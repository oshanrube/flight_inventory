<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiFlightControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/flight/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /flight/");
        $crawler = $client->click($crawler->selectLink('Create a new Flight')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'fi_flight[price]'                   => '100',
            'fi_flight[departure][date]'         => '2016-01-01',
            'fi_flight[arrival][date]'           => '2016-01-02',
            'fi_flight[departure][time][hour]'   => '09',
            'fi_flight[departure][time][minute]' => '00',
            'fi_flight[arrival][time][hour]'     => '04',
            'fi_flight[arrival][time][minute]'   => '00',
            'fi_flight[idorigin]'                => '1',
            'fi_flight[iddestination]'           => '1',
            'fi_flight[idflight]'                => '100'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("100")')->count(), 'Missing element td:contains("100")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fi_flight[price]' => '200',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "200"
        $this->assertGreaterThan(0, $crawler->filter('[value="200"]')->count(), 'Missing element [value="200"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/200/', $client->getResponse()->getContent());
    }
    //TODO
    //create flights with overlapping times
    //check for data types
}
