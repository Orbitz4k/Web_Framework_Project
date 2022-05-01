<?php

namespace App\Repository;

use App\Entity\SecretMode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SecretMode|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecretMode|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecretMode[]    findAll()
 * @method SecretMode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecretModeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecretMode::class);
    }

    // /**
    //  * @return SecretMode[] Returns an array of SecretMode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SecretMode
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
