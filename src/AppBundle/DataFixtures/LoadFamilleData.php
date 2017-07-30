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

use AppBundle\Entity\Famille;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Families test data in the database.
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
class LoadFamilleData implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Families to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $equipement = new Famille();
        $equipement->setName('Équipements dynamiques');

        $camera = new Famille();
        $camera->setName('Caméras');
        $camera->setParent($equipement);

        $pmv = new Famille();
        $pmv->setName('Panneaux à messages variables');
        $pmv->setParent($equipement);

        $comptage = new Famille();
        $comptage->setName('Stations de comptage');
        $comptage->setParent($equipement);

        $manager->persist($equipement);
        $manager->persist($camera);
        $manager->persist($pmv);
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
        return 10;
    }
}
