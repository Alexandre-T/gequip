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

        $rocade = new Axe();
        $rocade->setName('Rocade');
        $rocade->setCreator($dawny);
        $rocade->setUpdater($dawny);
        $rocade->setCode('A630');

        $a63 = new Axe();
        $a63->setName('Autoroute A63');
        $a63->setCreator($dawny);
        $a63->setUpdater($dawny);
        $a63->setCode('A63');

        $a62 = new Axe();
        $a62->setName('Autoroute A62');
        $a62->setCreator($dawny);
        $a62->setUpdater($dawny);
        $a62->setCode('A62');

        $manager->persist($rocade);
        $manager->persist($a63);
        $manager->persist($a62);
        $manager->flush();

        $this->addReference('axe-rocade', $rocade);
        $this->addReference('axe-a62', $a62);
        $this->addReference('axe-a63', $a63);
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
