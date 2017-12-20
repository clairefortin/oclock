<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Pet;
use AppBundle\Form\PetType;

class OwnerController extends Controller
{
    public function profileAction(Request $request)
    {
        // OCLOCK - on recupere le username de l'utilisateur en cours
        $userName = $this->getUser()->getUsername();

        // OCLOCK - on recupere les animaux de mon user courant
        $petList = $this->getUser()->getPets();
        

        // OCLOCK - on envoit les parametres a afficher dans ma vue
        return $this->render(
            'owner/profile.html.twig',
            array(
                'nomUtilisateur' => $userName,
                'listeAnimaux' => $petList
            )
        );
    }

    public function addPetAction(Request $request)
    {
        $pet = new Pet();

        $form = $this->createForm(PetType::class, $pet);

        // OCLOCK - Recupere le formulaire soumis
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // OCLOCK - Recupere l'utilisateur courant pour le mettre a jour et lui ajoute un animal
            $this->getUser()->addPet($pet);

            // OCLOCK - Persiste et enregistre l'utilisateur mis a jour avec son animal
            $em->persist($this->getUser());
            $em->flush();

            // OCLOCK - Redirige vers la route owner_profile
            return $this->redirectToRoute('owner_profile');
        }

        return $this->render(
            'owner/add_pet.html.twig',
            array('form' => $form->createView())
        );
    }
}
