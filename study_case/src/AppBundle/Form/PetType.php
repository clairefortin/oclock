<?php
namespace AppBundle\Form;

use AppBundle\Entity\Pet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PetType extends AbstractType
{
    //OCLOCK - Construction du formulaire d'ajout d'utilisateurs

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
         *  OCLOCK - Ajout de contraintes sur les champs pour que le type soit respecte
         *  Sur ce formulaire nous avons besoin des types text et integer
         *  mais il existe pleins d'autres types pour validation voir Symfony\Component\Form\Extension\Core\Type\
         */
        $builder
            ->add('nickname', TextType::class)
            ->add('type', TextType::class)
            ->add('age', IntegerType::class,array('attr' => array('min' => 1)))
        ;
    }

    //OCLOCK - Ajout des options du formulaire , ici mapping des entrees formulaire sur la classe AppBundle/Entity/Pet via data_class
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Pet::class,
        ));
    }
}