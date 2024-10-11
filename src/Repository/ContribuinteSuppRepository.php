<?php

namespace App\Repository;

use App\Entity\ContribuinteSupp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContribuinteSupp>
 *
 * @method ContribuinteSupp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContribuinteSupp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContribuinteSupp[]    findAll()
 * @method ContribuinteSupp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContribuinteSuppRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContribuinteSupp::class);
    }

//    /**
//     * @return ContribuinteSupp[] Returns an array of ContribuinteSupp objects
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

//    public function findOneBySomeField($value): ?ContribuinteSupp
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
