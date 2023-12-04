<?php

namespace App\Repository;

use App\Entity\Toys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Toys>
 *
 * @method Toys|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toys|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toys[]    findAll()
 * @method Toys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toys::class);
    }

//    /**
//     * @return Toys[] Returns an array of Toys objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Toys
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
