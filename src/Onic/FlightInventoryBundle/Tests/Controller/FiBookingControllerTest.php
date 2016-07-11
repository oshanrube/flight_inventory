<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiBookingControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/booking/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /booking/");
        $crawler = $client->click($crawler->selectLink('Create a new Booking')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'fi_booking[idflight]'    => '1',
            'fi_booking[idpassenger]' => '1',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("FA-001")')->count(), 'Missing element td:contains("FA-001")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fi_booking[idflight]' => '2',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "1"
        $this->assertGreaterThan(0, $crawler->filter('[value="1"]')->count(), 'Missing element [value="1"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/FA-001/', $client->getResponse()->getContent());
    }
}
