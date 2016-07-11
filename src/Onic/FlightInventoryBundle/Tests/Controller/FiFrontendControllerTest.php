<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiFrontendControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /frontend/");
        // Fill in the form and submit it
        $form = $crawler->selectButton('Filter')->form(array(
            'fi_flight_filter[idorigin]' => '1',
            'fi_flight_filter[iddestination]' => '1',
            'fi_flight_filter[departure]' => '2016-07-01',
            'fi_flight_filter[arrival]' => '2016-07-02',
            'fi_flight_filter[num_passengers]' => '1',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Filtered booking")')->count(), 'Missing element td:contains("Filtered booking")');

        //click on the link
        //make a booking
        //check bookings with seat numbers are full
    }
}
