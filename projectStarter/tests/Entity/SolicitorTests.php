<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SolicitorsRepository;
use App\Repository\ClientsRepository;

class SolicitorTests extends WebTestCase
{
    public function testRoleSolicitorCanEditSolicitors(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'Matt Murdock';
        $adminUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'Matt Murdock';
        $solicitor = $solicitorsRepository->findByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/85/edit';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated;

        $client->loginUser($adminUser);

        $submitButtonName = 'Update';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitors[Courts]'  => 'Boston',
            'solicitors[Clients]'  => '10',
            'solicitors[name]'  => 'It changes!',
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }
    public function testRoleSolicitorUserCanGoToClientIndex(): void
    {
        $client = static::createClient();

        $userName = 'Matt Murdock';
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByusername($userName);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/clients/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Clients index');
    }

    public function testRoleLawyerCanNOTMakeUsers(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user/new';
        $userName = 'Matt Murdock';
        $accessDeniedResponseCode403 = Response::HTTP_FORBIDDEN;

        // create client that automatically follow re-directs
        $client = static::createClient();
        $client->followRedirects();

        // login user
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByusername($userName);
        $client->loginUser($testUser);

        // Act
        $crawler = $client->request($method, $url);

        // Assert
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }
}