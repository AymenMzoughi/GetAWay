<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Reservation $entity, bool $flush = true): void
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
    public function remove(Reservation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }
    public function check1($id,$dd)
    {

        return $this->createQueryBuilder('r')
            ->where('r.idHebergement=:id')
            ->andWhere('r.dateDebut <= :dd   ')
            ->andWhere('r.dateFin  >= :dd  ')
            ->andWhere('r.etat  like :ap' )
            ->setParameter('ap','%Approuve%')
            ->setParameter('id',$id)
            ->setParameter('dd',$dd)
            ->getQuery()
            ->getResult();


    }
    public function check2($id,$df)
    {

        return $this->createQueryBuilder('r')
            ->where('r.idHebergement=:id')
            ->andWhere(' r.dateDebut <= :df  ')
            ->andWhere('  r.dateFin >=  :df ')
            ->andWhere('r.etat  like :ap' )
            ->setParameter('ap','%Approuve%')
            ->setParameter('id',$id)
            ->setParameter('df',$df)
            ->getQuery()
            ->getResult();


    }
    public function check3($id,$dd,$df)
    {

        return $this->createQueryBuilder('r')
            ->where('r.idHebergement=:id')
            ->andWhere('r.dateDebut <= :dd      ')
            ->andWhere(' r.dateFin >= :df')
            ->andWhere('r.etat  like :ap' )
            ->setParameter('ap','%Approuve%')
            ->setParameter('id',$id)
            ->setParameter('dd',$dd)
            ->setParameter('df',$df)
            ->getQuery()
            ->getResult();


    }
    public function check4($id,$dd,$df)
    {

        return $this->createQueryBuilder('r')
            ->where('r.idHebergement=:id')
            ->andWhere('r.dateDebut >= :dd    ')
            ->andWhere(' r.dateFin <=  :df')
            ->andWhere('r.etat  like :ap' )
            ->setParameter('ap','%Approuve%')
            ->setParameter('id',$id)
            ->setParameter('dd',$dd)
            ->setParameter('df',$df)
            ->getQuery()
            ->getResult();


    }
    public function check5($id,$dd,$df)
    {

        return $this->createQueryBuilder('r')
            ->where('r.idHebergement=:id')
            ->andWhere('r.dateDebut = :dd    ')
            ->andWhere(' r.dateFin = :df')
            ->andWhere('r.etat  like :ap' )
            ->setParameter('ap','%Approuve%')
            ->setParameter('id',$id)
            ->setParameter('dd',$dd)
            ->setParameter('df',$df)
            ->getQuery()
            ->getResult();


    }

    // /**
    //  * @return Reservation[] Returns an array of Reservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
