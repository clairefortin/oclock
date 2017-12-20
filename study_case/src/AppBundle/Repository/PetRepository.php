<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PetRepository extends EntityRepository
{

    public function findAllPublishedOrderedBySize()
    {
        return $this->createQueryBuilder('pet');
    }

    // OCLOCK - On recupere l'age moyen de l'ensemble des animaux des proprietaires
   public function getAverageAgePets(){
        return $this->getEntityManager()
            ->createQueryBuilder('p')
            ->select("avg(p.age)")
            ->from('pet', 'p')
            ->getQuery() // on execute la requete
            ->getOneOrNullResult();
    }


}