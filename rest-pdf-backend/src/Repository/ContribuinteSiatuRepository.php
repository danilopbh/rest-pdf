<?php

namespace App\Repository;

use App\Entity\ContribuinteSiatu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContribuinteSiatu>
 *
 * @method ContribuinteSiatu|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContribuinteSiatu|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContribuinteSiatu[]    findAll()
 * @method ContribuinteSiatu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContribuinteSiatuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContribuinteSiatu::class);
    }

//    /**
//     * @return ContribuinteSiatu[] Returns an array of ContribuinteSiatu objects
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

//    public function findOneBySomeField($value): ?ContribuinteSiatu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
