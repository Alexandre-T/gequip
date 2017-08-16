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

use AppBundle\Entity\Service;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load services initial production and dev data in the database.
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
class LoadServiceData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Services to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $dawny */
        $dawny = $this->getReference('user-dawny');

        $direction = new Service();
        $direction->setName('DIR Atlantique');
        $direction->setCreator($dawny);
        $direction->setUpdater($dawny);

        $cigt = new Service();
        $cigt->setName('CIGT Lormont');
        $cigt->setParent($direction);
        $cigt->setCreator($dawny);
        $cigt->setUpdater($dawny);

        $districtGironde = new Service();
        $districtGironde->setName('District de Gironde');
        $districtGironde->setParent($direction);
        $districtGironde->setCreator($dawny);
        $districtGironde->setUpdater($dawny);

        $ceiVillenave = new Service();
        $ceiVillenave->setName('CEI de Villenave');
        $ceiVillenave->setParent($districtGironde);
        $ceiVillenave->setCreator($dawny);
        $ceiVillenave->setUpdater($dawny);

        $manager->persist($direction);
        $manager->persist($cigt);
        $manager->persist($districtGironde);
        $manager->persist($ceiVillenave);
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
