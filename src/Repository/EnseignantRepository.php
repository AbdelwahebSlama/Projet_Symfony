<?php

namespace App\Repository;

use App\Entity\Enseignant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Enseignant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enseignant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enseignant[]    findAll()
 * @method Enseignant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnseignantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enseignant::class);
    }


    public function findEnseignantByEmail($email)
    {
        $query = $this->_em->createQuery(
            'SELECT e
FROM App\Entity\Enseignant e
WHERE e.email = :em 
'
        )
            ->setParameter('em', $email);
        return $query->execute();
    }


}
