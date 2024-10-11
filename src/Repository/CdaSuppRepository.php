<?php

namespace App\Repository;

use App\Entity\CdaSupp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CdaSupp>
 *
 * @method CdaSupp|null find($id, $lockMode = null, $lockVersion = null)
 * @method CdaSupp|null findOneBy(array $criteria, array $orderBy = null)
 * @method CdaSupp[]    findAll()
 * @method CdaSupp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdaSuppRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CdaSupp::class);
    }

//    /**
//     * @return CdaSupp[] Returns an array of CdaSupp objects
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

//    public function findOneBySomeField($value): ?CdaSupp
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
