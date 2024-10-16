<?php

namespace App\Repository;

use App\Entity\CdaSiatu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CdaSiatu>
 *
 * @method CdaSiatu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdaSiatu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdaSiatu[]    findAll()
 * @method CdaSiatu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdaSiatuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdaSiatu::class);
    }

//    /**
//     * @return CdaSiatu[] Returns an array of CdaSiatu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CdaSiatu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
