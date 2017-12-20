<?php
namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /*
     * OCLOCK - Requete permettant de verifier l'existence d'un utilisateur soit par username soit par email
     * la fonction est nommee loadUserByUsername et non loadUserByUsernameOrByemail car UserLoaderInterface l'impose
     */

    public function loadUserByUsername($username)
    {   $queryBuilder = $this->createQueryBuilder('u');

        $result = $queryBuilder->where('u.username = :username OR u.email = :email') //":monchamp" vas chercher les parametres setter ci dessous avec  "->setParameter"
        ->setParameter('username', $username) // champs username du formulaire -> on test le username
        ->setParameter('email', $username) // champs username du formulaire -> on test aussi le champs mail de la BDD
        ->getQuery() // on execute la requete
        ->getOneOrNullResult();// OCLOCK - Si on trouve une correspondance on la retourne sinon on renvoit null

        return $result;
    }
}