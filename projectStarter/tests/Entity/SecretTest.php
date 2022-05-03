<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\SecretModeRepository;
use Symfony\Component\HttpFoundation\Response;


class SecretTest extends WebTestCase
{
    public function testRoleSecretCanCreateNewData(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SecretModeRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'Daredevil';
        $solicitorUser = $userRepository->findOneByusername($userName);

        $httpMethod = 'GET';
        $url = '/secret/mode/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($solicitorUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'secret_mode[Daredevil]'  => '1',
            'secret_mode[successfulNights]'  => '19',
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }
    public function testRoleSecretCanNOTSeeUserList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user';
        $userName = 'Daredevil';
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