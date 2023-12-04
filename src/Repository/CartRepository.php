<?php

namespace App\Repository;

use App\Entity\Cart;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cart>
 *
 * @method Cart|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cart|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cart[]    findAll()
 * @method Cart[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }
    // SELECT `id`, `cquantity` FROM `cart` WHERE `ctoyid_id`= 1 
   /**
    * @return Cart[] Returns an array of Cart objects
    */
   public function findByPid($value): array
   {
       return $this->createQueryBuilder('c')
        ->select('c.id, c.cquantity')
           ->andWhere('c.ctoyid = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Cart
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
