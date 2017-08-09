<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  LoadDataFixture
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2016 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Status;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Status initial production data in the database.
 *
 * @category LoadDataFixture
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @codeCoverageIgnore
 */
class LoadStatusData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Status to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $dawny */
        $dawny = $this->getReference('user-dawny');

        $reception = new Status();
        //@TODO Translatable name
        $reception->setName('Réceptionné');
        $reception->setCreator($dawny);
        $reception->setUpdater($dawny);
        $reception->setInitial(true);
        $reception->setPresentation('Ce statut initial est déclaré à la création d’un équipement. Il n’est pas soumis à la gestion calendaire.');

        $exploitation = new Status();
        $exploitation->setName('En exploitation');
        $exploitation->setCreator($dawny);
        $exploitation->setUpdater($dawny);
        $exploitation->setManaged(true);
        $exploitation->setPresentation('Les équipements sous ce statut sont en exploitation, ils sont soumis à une gestion calendaire, à la maintenance.');

        $stock = new Status();
        $stock->setName('En stock');
        $stock->setCreator($dawny);
        $stock->setUpdater($dawny);
        $stock->setPresentation('Les équipements sous ce statut sont en stock et ne sont pas soumis à la maintenance. Une vérification aura lieu avant leur mise en exploitation.');

        $recyclage = new Status();
        $recyclage->setName('À recycler');
        $recyclage->setCreator($dawny);
        $recyclage->setUpdater($dawny);
        $recyclage->setManaged(true);
        $recyclage->setPresentation('Les équipements sont à recycler, ils ne sont plus sous maintenance, mais toujours dans l’inventaire.');

        $recycle = new Status();
        $recycle->setName('Recyclé');
        $recycle->setCreator($dawny);
        $recycle->setUpdater($dawny);
        $recycle->setDiscarded(true);
        $recycle->setPresentation('Les équipements ont été recyclé, ils ne sont ni sous maintenance ni compté dans l’inventaire.');

        $manager->persist($reception);
        $manager->persist($exploitation);
        $manager->persist($stock);
        $manager->persist($recyclage);
        $manager->persist($recycle);
        $manager->flush();
    }

    /**
     * Order of these data to be load.
     *
     * @return int
     */
    public function getOrder()
    {
        return 20;
    }
}
