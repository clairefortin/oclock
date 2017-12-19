<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/*
 *  OCLOCK - Creation de la classe generant un jeu d'essais pour tester:
 *  - Le bon fonctionnement de l'application
 *  - Avoir des donnees pour les tests fonctionnels (cf Behat/Mink)
 */
class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // OCLOCK - On va creer 5 utilisateurs uniques en incrementant le nom de l'utilisateur (user1, user2..), l'email et le mot de passe
        for ($i = 0; $i <= 5 ; $i++){
            // OCLOCK - Creation d'un objet user vide pour creer le mapping avec la base de donnee
            $user = new User();
            $user->setUsername('user'.$i);
            $user->setEmail('user'.$i.'@clock.com');

            // OCLOCK - On encode le mot de passe afin qu'il ai le format attendu dans security.yml ( cf encoders > bcrypt )
            $password = $this->encoder->encodePassword($user, 'pass'.$i);
            $user->setPassword($password);

            //OCLOCK - On persiste les donnees
            $manager->persist($user);
        }

        //OCLOCK - On enregistre toutes les donnees precedentes
        $manager->flush();
    }
}