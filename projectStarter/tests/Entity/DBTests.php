<?php

namespace App\Tests\Entity;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;
class DBTests extends WebTestCase
{
    public function testNumberOfUsers(){
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $expectedNumberOfEntities = 4;

        $userEntities = $userRepository->findAll();
        $this->assertCount($expectedNumberOfEntities, $userEntities);
    }

}