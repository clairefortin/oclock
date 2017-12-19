<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\UserRepository;

class OwnerController extends Controller
{
    public function profileAction(Request $request)
    {
        // OCLOCK - Je recupere le username de l'utilisateur en cours
        $userName = $this->getUser()->getUsername();

        // OCLOCK - J'envois les parametres a afficher dans ma vue
        return $this->render(
            'owner/profile.html.twig',
            array('nomUtilisateur' => $userName)
        );
    }
}
