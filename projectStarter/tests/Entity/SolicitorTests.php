<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SolicitorsRepository;
use App\Repository\ClientsRepository;

class SolicitorTests extends WebTestCase
{
    public function testRoleSolicitorCanCreateSolicitors(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'Matt Murdock';
        $solicitorUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'Matt Murdock';
        $solicitor = $solicitorsRepository->findByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($solicitorUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitors[Courts]'  => 'Ireland',
            'solicitors[Clients]'  => '15',
            'solicitors[name]'  => 'Solicitor',

        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }

    public function testRoleSolicitorCanCreateClients(){
        $client = static::createClient();
        $client->followRedirects();

        $solicitorsRepository = static::getContainer()->get(SolicitorsRepository::class);
        $userRepository = static::getContainer()->get(UserRepository::class);

        $userName = 'Matt Murdock';
        $solicitorUser = $userRepository->findOneByusername($userName);

        $solicitorName = 'Shane';
        $solicitor = $solicitorsRepository->findByName($solicitorName);

        $httpMethod = 'GET';
        $url = '/solicitors/new';

        $solicitor = $solicitorsRepository->findAll();
        $numberOfSolicitorsBeforeOneCreated = count($solicitor);
        $expectedNumberOfSolicitorsAfterOneCreated = $numberOfSolicitorsBeforeOneCreated + 1;

        $client->loginUser($solicitorUser);

        $submitButtonName = 'Save';
        $client->submit($client->request($httpMethod, $url)->selectButton($submitButtonName)->form([
            'solicitors[Courts]'  => 'Ireland',
            'solicitors[Clients]'  => '15',
            'solicitors[name]'  => 'Solicitor',

        ]));

        $solicitors = $solicitorsRepository->findAll();

        $this->assertCount($expectedNumberOfSolicitorsAfterOneCreated, $solicitors);
    }
}