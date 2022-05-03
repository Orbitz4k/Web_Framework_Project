<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repository\ClientsRepository;

class SolicitorCRUDTest extends WebTestCase
{
    public function testSolicitorCanSeeClients(){
        $method = 'GET';
        $url = '/clients';
        $userName = 'Matt Murdock';
        $okay200Code = Response::HTTP_OK;

        $client = static::createClient();
        $client->followRedirects();

        $clientsRepository = static::getContainer()->get(ClientsRepository::class);
        $testUser = $clientsRepository->findOneByname($userName);

        $crawler = $client->request($method, $url);

        $this->assertResponseIsSuccessful();
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($okay200Code, $responseCode);

        $expectedText = 'Clients index';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
}