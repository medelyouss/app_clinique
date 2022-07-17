<?php

namespace App\Principal\Repository;

use App\Principal\Entity\Optionsystem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Optionsystem>
 *
 * @method Optionsystem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Optionsystem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Optionsystem[]    findAll()
 * @method Optionsystem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionsystemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Optionsystem::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Optionsystem $entity, bool $flush = true): void
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
    public function remove(Optionsystem $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }



    public function getTheLastOne(): ?Optionsystem
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
