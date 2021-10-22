<?php

namespace App\Repository;

use App\Entity\SupprimerPassword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SupprimerPassword|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupprimerPassword|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupprimerPassword[]    findAll()
 * @method SupprimerPassword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupprimerPasswordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SupprimerPassword::class);
    }

    // /**
    //  * @return SupprimerPassword[] Returns an array of SupprimerPassword objects
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
    public function findOneBySomeField($value): ?SupprimerPassword
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
