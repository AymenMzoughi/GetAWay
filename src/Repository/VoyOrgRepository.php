<?php
namespace App\Repository;
use App\Entity\Voyageorganise;
use App\Repository\categVoyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;

/**
 * @method \App\Entity\Voyageorganise|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\Voyageorganise|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\Voyageorganise[]    findAll()
 * @method \App\Entity\Voyageorganise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class VoyOrgRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voyageorganise::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Voyageorganise $entity, bool $flush = true): void
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
    public function remove(Voyageorganise $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function stat()
    {

        $query = $this->createQueryBuilder('r')
            ->join('r.idcat','c')
            ->select(' c.nomcat as type, COUNT(r) as count')
            ->groupBy('c.nomcat');

        return $query->getQuery()->getResult();
    }

    /*
        public function findByvilledest($villedest){
            return $this->getEntityManager()->createQuery(
                       'SELECT c
                        FROM App\Entity\Voyageorganise c
                        WHERE c.villeDest LIKE :villeDest'
                )
                ->setParameter('villeDest', '%'.$villedest.'%')
                ->getResult();
        }*/

    public function findByidvoy($idvoy)
    {
        return $this->createQueryBuilder('p')
            ->where('p.idvoy LIKE :idvoy')
            ->setParameter('idvoy', $idvoy)
            ->getQuery()
            ->getResult()
            ;
    }



}