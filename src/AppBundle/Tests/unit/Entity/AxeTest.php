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

namespace AppBundle\Tests\unit\Entity;

use AppBundle\Entity\Axe;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Axe Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class AxeTest extends TestCase
{
    /**
     * @var Axe
     */
    private $axe;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->axe = new Axe();
    }

    /**
     * All value must be initialized after instantiation
     */
    public function testConstructor()
    {
        //All value must be null after instantiation
        self::assertNull($this->axe->getId());
        self::assertNull($this->axe->getCreated());
        self::assertNull($this->axe->getCreator());
        self::assertNull($this->axe->getName());
        self::assertNull($this->axe->getUpdated());
        self::assertNull($this->axe->getUpdater());
        self::assertNull($this->axe->getCode());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName()
    {
        $expected = 'name';

        self::assertEquals($this->axe, $this->axe->setName($expected));
        self::assertEquals($expected, $this->axe->getName());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetCode()
    {
        $expected = 'code';

        self::assertEquals($this->axe, $this->axe->setCode($expected));
        self::assertEquals($expected, $this->axe->getCode());
    }

    /**
     * Test getter and setter for Creator
     */
    public function testSetCreator()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->axe, $this->axe->setCreator($user));
        self::assertEquals($user, $this->axe->getCreator());
    }

    /**
     * Test getter and setter for Updater
     */
    public function testSetUpdater()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->axe, $this->axe->setUpdater($user));
        self::assertEquals($user, $this->axe->getUpdater());
    }
}
