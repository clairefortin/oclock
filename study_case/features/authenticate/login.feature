# OCLOCK
# - Les tests sont ecrits en francais pour une meilleure comprehension
# - neanmoins ils sont traditionellement ecrits en anglais
# - la syntaxe utilisee est le gherkin, tout est disponible ici : http://docs.behat.org/en/v2.5/guides/1.gherkin.html
# - la definition des phrases clef sont definies features > authenticate > login.feature
#
# Mot clefs :
# Feature : decrit le contexte de l'ensemble de scenario
# Scenario : decrit le contexte du test
# Given : point de depart du scenario
# And : precision des action a effectuer, il peux y avoir autant de and que l'on a besoin de precisions
# When : l'action qui va declencher le resultat
# Then : Le resultat attendu
#
# /!\ Ne pas oublier de jouer les fixtures (jeux d'essais) AVANT de lancer les tests : php bin/console doctrine:fixtures:load
#

Feature: Permettre de tester l'authentification d'un utilisateur

  Pour pouvoir acceder a la section owner_profile
  En tant qu'utilisateur
  Je dois etre capable qu'authentifie mon utilisateur

  Scenario: Je devrai etre authentifie avec mon nom d'utilisateur correct et mon mot de passe correct
    Given Je suis sur la page de login
    And Je m enregistre avec le username "user5" et le password "pass5"
    When J envois le formulaire
    Then Je devrais voir "Bienvenue"

# Example traditionnel

#Feature: Register
# In order to access to owner_profile section
# As a user
# I want to be able to authenticate my user on the application
#
# Scenario: I will be authenticate when I fill my right username and right password
# Given I am on the login page
# And I register with username "ooo" and password "888"
# When I submit the form
# Then I should see the text "bienvenue"


  Scenario: Je ne devrai pas etre authentifie avec nom d'utilisateur correct et mon mot de passe incorrect
    Given Je suis sur la page de login
    And Je m enregistre avec le username "user5" et le password "pass4"
    When J envois le formulaire
    Then Je devrais voir "Invalid credentials"