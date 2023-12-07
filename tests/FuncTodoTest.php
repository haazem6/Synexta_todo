<?php

namespace App\Tests;
use Symfony\Component\DomCrawler\Crawler;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunnctodoTest extends WebTestCase
{
    public function testCrudOperations()
    {
        $client = static::createClient();

        // Create a new Todo
        $crawler = $client->request('POST', '/todos/create', [
            'task' => 'New Task',
            'description' => 'New Description',
            'start_date' => '2023-02-01',
            'end_date' => '2023-02-28',
            'place' => 'New Place',
        ]);

        // Assert a successful response (HTTP 200)
        $this->assertResponseIsSuccessful();

        // Follow the redirect after form submission
        $crawler = $client->followRedirect();

        // Use Symfony's Crawler to inspect the HTML content
        $content = $client->getResponse()->getContent();
        $crawler = new Crawler($content);

        // Assert that the new Todo is displayed on the page
        $this->assertGreaterThan(0, $crawler->filter('body:contains("New Task")')->count());

        // Edit the Todo
        $crawler = $client->request('GET', '/todos/1/edit');
        $form = $crawler->selectButton('Save')->form();
        $form['task'] = 'Updated Task';

        // Submit the form
        $client->submit($form);

        // Assert a successful response (HTTP 200)
        $this->assertResponseIsSuccessful();

        // Follow the redirect after form submission
        $crawler = $client->followRedirect();

        // Assert that the updated Todo is displayed on the page
        $this->assertGreaterThan(0, $crawler->filter('body:contains("Updated Task")')->count());

        // Delete the Todo
        $client->request('DELETE', '/todos/1/delete');

        // Assert a successful response (HTTP 200)
        $this->assertResponseIsSuccessful();

        // Assert that the updated Todo is no longer displayed on the page
        $this->assertStringNotContainsString('Updated Task', $client->getResponse()->getContent());
    }
}
