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

use AppBundle\Entity\Axe;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Axe initial production data in the database.
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
class LoadAxeData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Axe to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $dawny */
        $dawny = $this->getReference('user-dawny');

        $a31 = new Axe();
        $a31->setName('Autoroute A31');
        $a31->setCreator($dawny);
        $a31->setUpdater($dawny);
        $a31->setCode('A31');

        $a330 = new Axe();
        $a330->setName('Autoroute A330');
        $a330->setCreator($dawny);
        $a330->setUpdater($dawny);
        $a330->setCode('A330');

        $a33 = new Axe();
        $a33->setName('Autoroute A33');
        $a33->setCreator($dawny);
        $a33->setUpdater($dawny);
        $a33->setCode('A33');


        $manager->persist($a31);
        $manager->persist($a330);
        $manager->persist($a33);
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
