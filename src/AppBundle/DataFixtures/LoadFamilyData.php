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

use AppBundle\Entity\Family;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Families initial production data in the database.
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
class LoadFamilyData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Families to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $dawny */
        $dawny = $this->getReference('user-dawny');

        $equipement = new Family();
        //@TODO Translatable name
        $equipement->setName('Équipements dynamiques');
        $equipement->setCreator($dawny);
        $equipement->setUpdater($dawny);

        $camera = new Family();
        $camera->setName('Caméras');
        $camera->setParent($equipement);
        $camera->setCreator($dawny);
        $camera->setUpdater($dawny);

        $pmv = new Family();
        $pmv->setName('Panneaux à messages variables');
        $pmv->setParent($equipement);
        $pmv->setCreator($dawny);
        $pmv->setUpdater($dawny);

        $portique = new Family();
        $portique->setName('PMV sur portique');
        $portique->setParent($pmv);
        $portique->setCreator($dawny);
        $portique->setUpdater($dawny);

        $simple = new Family();
        $simple->setName('PMV à simple mat');
        $simple->setParent($pmv);
        $simple->setCreator($dawny);
        $simple->setUpdater($dawny);

        $comptage = new Family();
        $comptage->setName('Stations de comptage');
        $comptage->setParent($equipement);
        $comptage->setCreator($dawny);
        $comptage->setUpdater($dawny);

        $manager->persist($equipement);
        $manager->persist($camera);
        $manager->persist($pmv);
        $manager->persist($portique);
        $manager->persist($simple);
        $manager->persist($comptage);
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
