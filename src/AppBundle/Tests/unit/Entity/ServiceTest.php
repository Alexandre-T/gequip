<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Testing
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Service;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Service Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class ServiceTest extends TestCase
{
    /**
     * Instance to test.
     *
     * @var Service
     */
    private $service;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->service = new Service();
    }

    /**
     * All value must be null after creation
     */
    public function testConstructor()
    {
        self::assertNull($this->service->getId());
        self::assertNull($this->service->getChildren());
        self::assertNull($this->service->getCreated());
        self::assertNull($this->service->getLeft());
        self::assertNull($this->service->getLevel());
        self::assertNull($this->service->getName());
        self::assertNull($this->service->getParent());
        self::assertNull($this->service->getRight());
        self::assertNull($this->service->getRoot());
        self::assertNull($this->service->getUpdated());
        self::assertNull($this->service->getUpdater());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName()
    {
        $expected = 'name';

        self::assertEquals($this->service, $this->service->setName($expected));
        self::assertEquals($expected, $this->service->getName());
    }

    /**
     * Test getter and setter for Parent
     */
    public function testSetParent()
    {
        $parent = new Service();
        $parent->setName('parent');

        self::assertEquals($this->service, $this->service->setParent($parent));
        self::assertEquals($parent, $this->service->getParent());
    }

    /**
     * Test getter and setter for Parent
     */
    public function testSetUpdater()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->service, $this->service->setUpdater($user));
        self::assertEquals($user, $this->service->getUpdater());
    }
}
