<?php

namespace App\Repository;

use App\Entity\Triangle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Triangle>
 *
 * @method Triangle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Triangle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Triangle[]    findAll()
 * @method Triangle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriangleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Triangle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Triangle $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Triangle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Triangle[] Returns an array of Triangle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Triangle
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //Triangle controller function
    public function getTriangles($id)
    {
        $qb = $this->createQueryBuilder('t');

        $qb->addSelect('t')
            ->andWhere('t.id = :id')
            ->setParameter('id', $id);
        
        return $qb->getQuery()->getResult(Query::HYDRATE_ARRAY);

        //return $qb->setMaxResults($parameters['per_page'])->setFirstResult(0)->getQuery()->getResult(Query::HYDRATE_ARRAY);
    }
}
