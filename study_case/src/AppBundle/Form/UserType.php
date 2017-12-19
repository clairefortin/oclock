<?php
namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    //OCLOCK - Construction du formulaire d'ajout d'utilisateurs

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
         *  OCLOCK - Ajout de contraintes sur les champs pour que le type soit respecte
         *  Sur ce formulaire nous avons besoin des types email, text et repeat
         *  mais il existe pleins d'autres types pour validation voir Symfony\Component\Form\Extension\Core\Type\
         */
        $builder
            ->add('email', EmailType::class)
            ->add('username', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Repeter mot de passe'),
            ))
        ;
    }

    //OCLOCK - Ajout des options du formulaire , ici mapping des entrees formulaire sur la classe AppBundle/Entity/User via data_class
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}