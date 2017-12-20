<?php
namespace AppBundle\Controller;

use AppBundle\Form\UserType;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // OCLOCK - Contruction du formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // OCLOCK - Recupere le formulaire soumis
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // OCLOCK - Encode le mot de passe (cd security.yml encoder)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // OCLOCK - Enregistre l'utilisateur
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // OCLOCK - Redirige vers la route owner_profile
            return $this->redirectToRoute('owner_profile');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
}