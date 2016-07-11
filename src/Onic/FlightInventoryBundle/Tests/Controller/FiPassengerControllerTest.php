<?php

namespace Onic\FlightInventoryBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FiPassengerControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/passenger/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /passenger/");
        $crawler = $client->click($crawler->selectLink('Create a new Passenger')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'fi_passenger[firstname]'       => 'Firstname',
            'fi_passenger[lastname]'        => 'Lastname',
            'fi_passenger[passport_number]' => '1234567DB',
            'fi_passenger[email]'           => 'FirstnameL@gmail.com',
            'fi_passenger[payment_method]'  => 'cach',
            'fi_passenger[dob]'             => '2016-07-06',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Firstname")')->count(), 'Missing element td:contains("Firstname")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'fi_passenger[firstname]' => 'NewFirstname',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="NewFirstname"]')->count(), 'Missing element [value="NewFirstname"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/NewFirstname/', $client->getResponse()->getContent());
    }
}
