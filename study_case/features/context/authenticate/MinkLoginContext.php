<?php

namespace Acme\Tests\Behat\Context\Registration;

use Behat\MinkExtension\Context\MinkContext;

/**
 * Mink register context.
 * OCLOCK - Execute les contextes precedemment decris pour être interpretes reelement par le navigateur
 * Toutes les fonctionnalitees de mink sont disponibles ici http://mink.behat.org/en/latest/
 */
class MinkRegisterContext extends MinkContext
{
    /**
     * @Given Je suis sur la page de login
     */
    public function jeSuisSurLaPageDeLogin()
    {
        $this->visit('/login');
    }

    /**
     * @Given Je m enregistre avec le username :arg1 et le password :arg2
     */
    public function jeMEnregistreAvecLeUsernameEtLePassword($username, $password)
    {
        $this->fillField('loginForm[username]', $username);
        $this->fillField('loginForm[password]', $password);
    }

    /**
     * @When J envois le formulaire
     */
    public function jEnvoisLeFormulaire()
    {
        $this->pressButton('Login');
    }

    /**
     * @Then Je devrais voir :arg1
     */
    public function jeDevraisVoir($arg1)
    {
        $this->assertPageContainsText($arg1);
    }
}