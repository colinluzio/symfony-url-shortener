<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    private $client;
    private $crawler;

    public function __construct()
    {
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
    }
    public function testIndex()
    {
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertContains('Generate Short Url', $this->crawler->filter('.container h1')->text());
    }
    public function testEmptySubmit()
    {
        $form = $this->crawler->filter('button#form_save')->form(array(
            'form[url]' => '',
        ),'POST');
        $page = $this->client->submit($form);
        $this->assertContains('This value should not be blank', $page->filter('ul.list-unstyled')->first()->text());
    }
    public function testSubmit()
    {
        $form = $this->crawler->filter('button#form_save')->form(array(
            'form[url]' => 'test',
        ),'POST');
        $otherPage = $this->client->submit($form);

        $this->assertContains('Please include http/https protocols', $otherPage->filter('ul.list-unstyled')->first()->text());
    }
    public function testSubmitAddress()
    {
        $form = $this->crawler->filter('button#form_save')->form(array(
            'form[url]' => 'www.google.com',
        ),'POST');
        $otherPage = $this->client->submit($form);

        $this->assertContains('Please include http/https protocols', $otherPage->filter('ul.list-unstyled')->first()->text());
    }

}
