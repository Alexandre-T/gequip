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

use AppBundle\Entity\Criticity;
use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Load Criticity initial production data in the database.
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
class LoadCriticityData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    /**
     * Load Criticity to database.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var User $dawny */
        $dawny = $this->getReference('user-dawny');

        $maximal = new Criticity();
        $maximal->setName('Maximale');
        $maximal->setCreator($dawny);
        $maximal->setUpdater($dawny);
        $maximal->setIntervention('P1D');
        $maximal->setRecovery('P3D');
        $maximal->setWorking('P1Y');

        $normal = new Criticity();
        $normal->setName('Normale');
        $normal->setCreator($dawny);
        $normal->setUpdater($dawny);
        $normal->setIntervention('P3D');
        $normal->setRecovery('P1W');
        $normal->setWorking('P6M');

        $faible = new Criticity();
        $faible->setName('Faible');
        $faible->setCreator($dawny);
        $faible->setUpdater($dawny);
        $faible->setIntervention('P5D');
        $faible->setRecovery('P2W');
        $faible->setWorking('P3M');
        

        $manager->persist($maximal);
        $manager->persist($normal);
        $manager->persist($faible);
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
