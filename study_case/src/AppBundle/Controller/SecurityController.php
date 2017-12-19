<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/*
 *  OCLOCK - SecurityController est un controller specifique de Symfony
 *           toutes les actions de login passeront automatiquement par celui ci
 */
class SecurityController extends Controller {

  public function loginAction(Request $request, AuthenticationUtils $authUtils) {

      // OCLOCK - Si l'utilisateur est deja authentifie on redirige vers owner profile
      $securityContext = $this->container->get('security.authorization_checker');
      //var_dump($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED'));die;
      if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')){
          return $this->redirectToRoute('owner_profile');
      }

      // OCLOCK - Recupere erreur de l'objet du type AuthenticationUtils si il y en a une
      $error = $authUtils->getLastAuthenticationError();

      // OCLOCK - Recupere dernier username saisi pour pouvoir le re-afficher en cas d'erreur
      $lastUsername = $authUtils->getLastUsername();

      return $this->render('security/login.html.twig', array(
          'last_username' => $lastUsername,
          'error'         => $error,
      ));

  }

    public function logoutAction() {

    }
}
