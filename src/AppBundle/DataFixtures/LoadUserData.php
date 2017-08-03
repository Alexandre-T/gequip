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

use AppBundle\Entity\User;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Load User production data in the database.
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
class LoadUserData extends AbstractFixture implements ContainerAwareInterface, FixtureInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load users to database.
     *
     * @param ObjectManager $manager
     * @throws EntityNotFoundException if Dawny user was not loaded before using LoadDataFituresBundle.
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        /** @var User $dawny */
        $dawny = $userManager->createUser();
        $dawny->setUsername('Dawny');
        $dawny->setEmail('no-reply@example.org');
        $dawny->setPlainPassword('password');
        $dawny->setEnabled(false);
        //@TODO Translatable description
        $dawny->setPresentation(
            '*Dawny* is our bot. She creates some entities during installation process,
             like first family like "dynamic equipments".'
        );
        $userManager->updateUser($dawny);

        //We add this data if we are in test, dev environments
        if (in_array($this->container->get('kernel')->getEnvironment(), array('test', 'dev'))) {
            $user1 = $userManager->createUser();
            $user1->setUsername('User1');
            $user1->setEmail('user1@example.org');
            $user1->setPlainPassword('password');
            $user1->setEnabled(true);
            $user1->setPresentation('*User1* is a test user with role ROLE_USER');
            $userManager->updateUser($user1);
            $this->addReference('user-user1', $user1);

            $admin1 = $userManager->createUser();
            $admin1->setUsername('Admin1');
            $admin1->setEmail('admin1@example.org');
            $admin1->setPlainPassword('password');
            $admin1->setEnabled(true);
            $admin1->setPresentation('*Admin1* is a test user with role ROLE_ADMIN');
            $admin1->setRoles(['ROLE_ADMIN']);
            $userManager->updateUser($admin1);
            $this->addReference('user-admin1', $admin1);

            $superAdmin1 = $userManager->createUser();
            $superAdmin1->setUsername('Super Admin1');
            $superAdmin1->setEmail('superAdmin1@example.org');
            $superAdmin1->setPlainPassword('password');
            $superAdmin1->setEnabled(true);
            $superAdmin1->setPresentation('*SuperAdmin1* is a test user with role ROLE_SUPER_ADMIN');
            $superAdmin1->setRoles(['ROLE_SUPER_ADMIN']);
            $userManager->updateUser($superAdmin1);
            $this->addReference('user-superAdmin1', $superAdmin1);

        }

        $manager->flush();
        $this->addReference('user-dawny', $dawny);
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
