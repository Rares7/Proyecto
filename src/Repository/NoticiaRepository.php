<?php

namespace App\Repository;

use App\Entity\Noticia;
use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Noticia>
 *
 * @method Noticia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Noticia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Noticia[]    findAll()
 * @method Noticia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoticiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Noticia::class);
    }

    public function findAllPaginated($page = 1, $categoriaId=null,  $limit = 10){
        $qb = $this->createQueryBuilder('n');
        if($categoriaId!=null) {
            $qb->innerJoin(Categoria::class, 'c', Join::WITH, 'c.id = n.categoria');
            $qb->andWhere("c.id = :idcat")->setParameter("idcat", $categoriaId);
        }
        
        $paginator = new Paginator($qb);

        $paginator->getQuery()
            ->setFirstResult($limit*($page-1))
            ->setMaxResults($limit);

        return array('paginator' => $paginator, 'maxPages' => ceil($paginator->count()/$limit));
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Noticia $entity, bool $flush = false): void
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
    public function remove(Noticia $entity, bool $flush = false): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

//    /**
//     * @return Noticia[] Returns an array of Noticia objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Noticia
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
