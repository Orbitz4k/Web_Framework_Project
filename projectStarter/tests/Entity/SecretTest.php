<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
use App\Repository\SecretModeRepository;


class SecretTest extends WebTestCase
{
    public function testRoleSolicitorCanCreateSolicitors(){
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
}