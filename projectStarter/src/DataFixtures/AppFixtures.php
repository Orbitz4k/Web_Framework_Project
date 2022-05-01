<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Entity\Solicitors;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $solicitor = new Solicitors();
        $solicitor->setName("Matt Murdock");
        $solicitor->setClients("1000");
        $solicitor->setCourts("New York");
        $manager->persist($solicitor);
        $manager->flush();

        $solicitor = new Solicitors();
        $solicitor->setName("Foggy Nelson");
        $solicitor->setClients("1001");
        $solicitor->setCourts("New York");
        $manager->persist($solicitor);
        $manager->flush();

        UserFactory::createOne([
            'username' => 'matt',
            'password' => 'smith',
            'role' => 'ROLE_ADMIN'
        ]);

        UserFactory::createOne([
            'username' => 'Matt Murdock',
            'password' => '12345',
            'role' => 'ROLE_LAWYER'
        ]);
        UserFactory::createOne([
            'username' => 'Foggy Nelson',
            'password' => '12345',
            'role' => 'ROLE_LAWYER'
        ]);
        UserFactory::createOne([
            'username' => 'Daredevil',
            'password' => 'D',
            'role' => 'ROLE_SECRET'
        ]);
    }
}
