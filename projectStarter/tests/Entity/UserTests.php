<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ReviewsRepository;

class UserTests extends WebTestCase
{
    public function testRoleUsersCanCreateReviews(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(ReviewsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'user';
        $normalUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'wow so good and amazing';
        $solicitor = $solicitorsRepository->findByreview($solicitorName);

        $httpMethod = 'GET';
        $url = '/reviews/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($normalUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'reviews[Rating]'  => '50',
            'reviews[Rekekekemend]'  => '1',
            'reviews[review]'  => 'test',
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }
    public function testRoleUserCanNOTSeeUserList(): void
    {
        // Arrange
        $method = 'GET';
        $url = '/user';
        $userName = 'user';
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