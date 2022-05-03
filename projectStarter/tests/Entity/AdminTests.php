<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SolicitorsRepository;

class AdminTests extends WebTestCase
{
    public function testRoleAdminCanCreateSolicitors(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'matt';
        $adminUser = $userRepository->findOneByEmail($userName);

        $solicitorName = 'Foggy Nelson';
        $solicitor = $solicitorsRepository->findOneByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($adminUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitor[Name]'  => 'Test Solicitor',
            'solicitor[Courts]'  => 'Boston',
            'solicitor[Clients]'  => '10',
            'solicitor[Id]'  => $solicitor->getId(),
        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);

    }
}