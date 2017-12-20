<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PetRepository extends EntityRepository
{
    // OCLOCK - On recupere l'age moyen de l'ensemble des animaux des proprietaires
   public function getAverageAgePets(){
        $queryBuilder = $this->createQueryBuilder('p');

        $result = $queryBuilder->select("AVG(p.age) as moyenne_age")
                               ->getQuery() // on execute la requete
                               ->getSingleScalarResult(); // OCLOCK - getSingleScalarResult : On souhaite retourner un seul resulat issus d'un calcul (avg,count,...)

        return  $result;
    }
}