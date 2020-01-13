<?php

namespace App\Repository;

use App\Entity\Etudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Etudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudiant[]    findAll($email)
 * @method Etudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudiant::class);
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function findEtudiantByEmail($email, $password)
    {
//        $query = $this->_em->createQuery(
//            'SELECT e
//FROM App\Entity\Etudiant e
//WHERE e.email = :ema AND e.password = :pass
//')
//            ->setParameter('ema', $email)
//            ->setParameter('pass', $password);
//
//        return $query->execute();
        return null;
    }

    /**
     * @param $email
     * @return mixed|null
     */
    public function findAll12($email)
    {
        $query = $this->_em->createQuery(
            'SELECT e
FROM App\Entity\Etudiant e
WHERE e.nom = :ema
')
            ->setParameter('ema', $email);

        return $query->execute();
        return null;

    }


}
