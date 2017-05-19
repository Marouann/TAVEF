<?php
// src/MC/PlatformBundle/DataFixtures/ORM/LoadPerson.php

namespace MC\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MC\PlatformBundle\Entity\Person;

class LoadPerson implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $last_names = array(
      'Zidane',
      'Henry',
      'Karabatic',
      'Karabatic',
      'Omeyer'
    );

    $first_names = array(
      'Zinedine',
      'Thierry',
      'Nikola',
      'Luka',
      'Thierry'
    );

    $pseudos = array(
      'Zizou',
      'TH',
      'Niko',
      'Lulu',
      'Titi'
    );

    $emails = array(
      'zizou@star.fr',
      'TH@star.fr',
      'niko@star.fr',
      'lulu@star.fr',
      'titi@star.fr'
    );

    for ($i = 0; $i <5; $i++) {
      $person = new Person();
      $person->setLastName($last_names[$i]);
      $person->setFirstName($first_names[$i]);
      $person->setPseudo($pseudos[$i]);
      $person->setEmail($emails[$i]);

      // On la persiste
      $manager->persist($person);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
