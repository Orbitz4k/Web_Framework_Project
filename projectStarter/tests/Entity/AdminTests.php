<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SolicitorsRepository;
use App\Repository\ClientsRepository;

class AdminTests extends WebTestCase
{
    public function testRoleAdminCanCreateSolicitors(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'matt';
        $adminUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'Matt Murdock';
        $solicitor = $solicitorsRepository->findByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($adminUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitors[Courts]'  => 'Boston',
            'solicitors[Clients]'  => '10',
            'solicitors[name]'  => 'test',
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }

    public function testRoleAdminCanEditSolicitors(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'matt';
        $adminUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'Matt Murdock';
        $solicitor = $solicitorsRepository->findByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/74/edit';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated;

        $client->loginUser($adminUser);

        $submitButtonName = 'Update';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitors[Courts]'  => 'Boston',
            'solicitors[Clients]'  => '10',
            'solicitors[name]'  => 'Weeeee',
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }

    public function testRoleAdminUserCanGoToSolicitorsIndex(): void
    {
        $client = static::createClient();

        $userName = 'matt';
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByusername($userName);
        $client->loginUser($testUser);

        $crawler = $client->request('GET', '/solicitors/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Solicitors index');
    }
}