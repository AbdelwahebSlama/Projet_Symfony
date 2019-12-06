<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll()
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    // /**
    //  * @return Etudiant[] Returns an array of Etudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    public function findEtudiantByEmail($email, $password)
    {
        $query = $this->_em->createQuery(
            'SELECT e
FROM App\Entity\Etudiant e
WHERE e.email = :em AND e.motpasse = :pass
'
        )
            ->setParameter('em', $email)
            ->setParameter('pass', $password);
        return $query->execute();
    }

    /*
    public function findOneBySomeField($value): ?Etudiant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
