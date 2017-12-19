<?php

namespace Behat\Context\Authenticate;

use AppBundle\Entity\User;
use Behat\Behat\Context\Context;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Integration login context.
 */
class IntegrationLoginContext implements Context
{
    /**
     * User
     */
    protected $user;

    /**
     * boolean
     */
    protected $response;


    /**
     * @Given Je suis sur la page de login
     */
    public function jeSuisSurLaPageDeLogin(){
        $this->user = new User();
    }

    /**
     * @Given Je m enregistre avec le username :arg1 et le password :arg2
     */
    public function jeMEnregistreAvecLeUsernameEtLePassword($username, $password){
        $this->user->setUsername($username);
        $this->user->setPassword($password);
    }

    /**
     * @When J envois le formulaire
     */
    public function jEnvoisLeFormulaire(){
        // OCLOCK - Je set les parametres de ma requete
        $parameters = array(
            '_username' => $this->user->getUsername(),
            '_password' => $this->user->getPassword()
        );

        // OCLOCK - Je recupere l'url souhaitee /!\ recuperer l'url absolue ....
        $uri = '/login';

        // OCLOCK - J'instancie le client qui va effectuer une requete post sur le formulaire
        $client = new \GuzzleHttp\Client();

        // OCLOCK - Je recupere la reponse
        $this->response = $client->request('POST', $uri, $parameters);
    }

    /**
     * @Then Je devrais voir :arg1
     */
    public function jeDevraisVoir($arg1){
        // OCLOCK - Si le status de ma reponse n'est pas en erreur et que je ne recois pas le contenu attendu
        if (
            $this->response->getStatusCode() == 200 &&
            strpos( $this->response->getBody(), $arg1) === false
        ){
            throw new \RuntimeException('User is not registered.');
        }
    }
}