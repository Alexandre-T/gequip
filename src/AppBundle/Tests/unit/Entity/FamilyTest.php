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

use AppBundle\Entity\Family;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Family Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class FamilyTest extends TestCase
{
    /**
     * Instance to test.
     *
     * @var Family
     */
    private $family;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->family = new Family();
    }

    /**
     * All value must be null after creation
     */
    public function testConstructor()
    {
        self::assertNull($this->family->getId());
        self::assertNull($this->family->getChildren());
        self::assertNull($this->family->getCreated());
        self::assertNull($this->family->getLeft());
        self::assertNull($this->family->getLevel());
        self::assertNull($this->family->getName());
        self::assertNull($this->family->getParent());
        self::assertNull($this->family->getRight());
        self::assertNull($this->family->getRoot());
        self::assertNull($this->family->getUpdated());
        self::assertNull($this->family->getUpdater());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName()
    {
        $expected = 'name';

        self::assertEquals($this->family, $this->family->setName($expected));
        self::assertEquals($expected, $this->family->getName());
    }

    /**
     * Test getter and setter for Parent
     */
    public function testSetParent()
    {
        $parent = new Family();
        $parent->setName('parent');

        self::assertEquals($this->family, $this->family->setParent($parent));
        self::assertEquals($parent, $this->family->getParent());
    }

    /**
     * Test getter and setter for Parent
     */
    public function testSetUpdater()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->family, $this->family->setUpdater($user));
        self::assertEquals($user, $this->family->getUpdater());
    }
}
