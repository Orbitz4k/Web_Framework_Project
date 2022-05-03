<?php

namespace App\Tests\Entity;
use App\Repository\SolicitorsRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
class DBTests extends WebTestCase
{
    public function testNumberOfUsers(){
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $expectedNumberOfEntities = 5;

        $userEntities = $userRepository->findAll();
        $this->assertCount($expectedNumberOfEntities, $userEntities);
    }
    public function testNumberOfSolicitors(){
        $client = static::createClient();
        $userRepository = static::getContainer()->get(SolicitorsRepository::class);
        $expectedNumberOfEntities = 2;

        $userEntities = $userRepository->findAll();
        $this->assertCount($expectedNumberOfEntities, $userEntities);
    }

}