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

use AppBundle\Entity\Criticity;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Criticity Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class CriticityTest extends TestCase
{
    /**
     * @var Criticity
     */
    private $criticity;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->criticity = new Criticity();
    }

    /**
     * All value must be initialized after instantiation
     */
    public function testConstructor()
    {
        //All value must be null after instantiation
        self::assertNull($this->criticity->getId());
        self::assertNull($this->criticity->getCreated());
        self::assertNull($this->criticity->getCreator());
        self::assertNull($this->criticity->getName());
        self::assertNull($this->criticity->getUpdated());
        self::assertNull($this->criticity->getUpdater());
        self::assertNull($this->criticity->getIntervention());
        self::assertNull($this->criticity->getRecovery());
        self::assertNull($this->criticity->getWorking());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName()
    {
        $expected = 'name';

        self::assertEquals($this->criticity, $this->criticity->setName($expected));
        self::assertEquals($expected, $this->criticity->getName());
    }

    /**
     * Test getter and setter for Intervention
     */
    public function testSetIntervention()
    {
        $expected = 'intervention';

        self::assertEquals($this->criticity, $this->criticity->setIntervention($expected));
        self::assertEquals($expected, $this->criticity->getIntervention());
    }

    /**
     * Test getter and setter for Recovery
     */
    public function testSetRecovery()
    {
        $expected = 'recovery';

        self::assertEquals($this->criticity, $this->criticity->setRecovery($expected));
        self::assertEquals($expected, $this->criticity->getRecovery());
    }

    /**
     * Test getter and setter for Working
     */
    public function testSetWorking()
    {
        $expected = 'working';

        self::assertEquals($this->criticity, $this->criticity->setWorking($expected));
        self::assertEquals($expected, $this->criticity->getWorking());
    }

    /**
     * Test getter and setter for Creator
     */
    public function testSetCreator()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->criticity, $this->criticity->setCreator($user));
        self::assertEquals($user, $this->criticity->getCreator());
    }

    /**
     * Test getter and setter for Updater
     */
    public function testSetUpdater()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->criticity, $this->criticity->setUpdater($user));
        self::assertEquals($user, $this->criticity->getUpdater());
    }
}
