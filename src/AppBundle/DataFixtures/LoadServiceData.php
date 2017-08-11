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
        $direction->setName('DIR Est');
        $direction->setCreator($dawny);
        $direction->setUpdater($dawny);

        $divisionMetz = new Service();
        $divisionMetz->setName('D.E. de Metz');
        $divisionMetz->setParent($direction);
        $divisionMetz->setCreator($dawny);
        $divisionMetz->setUpdater($dawny);

        $divisionStrasbourg = new Service();
        $divisionStrasbourg->setName('D.E. de Strasbourg');
        $divisionStrasbourg->setParent($direction);
        $divisionStrasbourg->setCreator($dawny);
        $divisionStrasbourg->setUpdater($dawny);

        $divisionBesancon = new Service();
        $divisionBesancon->setName('D.E. de Besançon');
        $divisionBesancon->setParent($direction);
        $divisionBesancon->setCreator($dawny);
        $divisionBesancon->setUpdater($dawny);

        $manager->persist($direction);
        $manager->persist($divisionMetz);
        $manager->persist($divisionStrasbourg);
        $manager->persist($divisionBesancon);
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
