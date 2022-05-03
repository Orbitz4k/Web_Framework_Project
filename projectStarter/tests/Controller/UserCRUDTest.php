<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;


class UserCRUDTest extends WebTestCase
{
    public function testAdminCanSeeUser(){
        $method = 'GET';
        $url = '/user';
        $userName = 'matt';
        $okay200Code = Response::HTTP_OK;

        $client = static::createClient();
        $client->followRedirects();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByusername($userName);
        $client->loginUser($testUser);

        $crawler = $client->request($method, $url);

        $this->assertResponseIsSuccessful();
        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($okay200Code, $responseCode);

        $expectedText = 'User index';
        $contentSelector = 'body h1';
        $this->assertSelectorTextContains($contentSelector, $expectedText);
    }
    public function testRoleUserUserCanNOTSeeUserList(): void{
        $method = 'GET';
        $url = '/user';
        $userName = 'user';
        $accessDeniedResponseCode403 = Response::HTTP_FORBIDDEN;

        $client = static::createClient();
        $client->followRedirects();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByusername($userName);
        $client->loginUser($testUser);

        $crawler = $client->request($method, $url);

        $responseCode = $client->getResponse()->getStatusCode();
        $this->assertSame($accessDeniedResponseCode403, $responseCode);
    }

}