<?php

namespace App\Repository;

use App\Entity\Device;
use App\Search\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Device>
 *
 * @method Device|null find($id, $lockMode = null, $lockVersion = null)
 * @method Device|null findOneBy(array $criteria, array $orderBy = null)
 * @method Device[]    findAll()
 * @method Device[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviceRepository extends ServiceEntityRepository
{
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Device::class);
        $this->paginator = $paginator;
    }

    public function save(Device $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Device $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('d')
            ->leftJoin('d.brand', 'b');
            //->select('b', 'd')
            //->join('d.brand', 'b');

        if (!empty($search->q)) {
            $query->andWhere('d.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        /*if (!empty($search->min)) {
            $query->andWhere('d.price >= :min')
                ->setParameter('min', $search->min);
        }

        if (!empty($search->max)) {
            $query->andWhere('d.price <= :max')
                ->setParameter('max', $search->max);
        }*/

        if (!empty($search->brand)) {
            $query = $query
                ->andWhere('b.id IN (:brand)')
                ->setParameter('brand', $search->brand);
        }

        //$query = $query->getQuery()->getResult();

        /*$query->getQuery()->getResult();
        return $this->paginator->paginate(
            $query,
            1,
            3
        );*/

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            2
        );
    }

    /*private function getSearchQuery(SearchData $search, $ignorePrice = false): QueryBuilder
    {
    }*/

//    /**
//     * @return Device[] Returns an array of Device objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Device
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

}
