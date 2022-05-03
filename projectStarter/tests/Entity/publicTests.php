<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class publicTests extends WebTestCase
{
    public function testHomePageTitleText(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Nelson and Murdock');
    }
    public function testPublicCanSeeStats(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/solicitors/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Solicitors index');
    }
    public function testPublicCantSeeUserIndex(): void
    {
        $method = 'GET';
        $url = '/user/new';
        $accessDeniedResponseCode403 = Response::HTTP_FOUND;
        $client = static::createClient();
        $crawler = $client->request($method, $url);

        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }
}