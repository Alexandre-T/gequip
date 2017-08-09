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

use AppBundle\Entity\Status;
use AppBundle\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Status Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class StatusTest extends TestCase
{
    /**
     * @var Status
     */
    private $status;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->status = new Status();
    }

    /**
     * All value must be initialized after instantiation
     */
    public function testConstructor()
    {
        //All value must be null after instantiation
        self::assertNull($this->status->getId());
        self::assertNull($this->status->getCreated());
        self::assertNull($this->status->getCreator());
        self::assertNull($this->status->getName());
        self::assertNull($this->status->getUpdated());
        self::assertNull($this->status->getUpdater());
        self::assertNull($this->status->getPresentation());

        //All value must be false after instantiation
        self::assertFalse($this->status->getDiscarded());
        self::assertFalse($this->status->getInitial());
        self::assertFalse($this->status->getManaged());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName()
    {
        $expected = 'name';

        self::assertEquals($this->status, $this->status->setName($expected));
        self::assertEquals($expected, $this->status->getName());
    }

    /**
     * Test getter and setter for Presentation
     */
    public function testSetPresentation()
    {
        $expected = 'presentation';

        self::assertEquals($this->status, $this->status->setPresentation($expected));
        self::assertEquals($expected, $this->status->getPresentation());
    }

    /**
     * Test getter and setter for Initial
     */
    public function testSetInitial()
    {
        $expected = true;

        self::assertEquals($this->status, $this->status->setInitial($expected));
        self::assertTrue($this->status->getInitial());

        $expected = false;

        self::assertEquals($this->status, $this->status->setInitial($expected));
        self::assertFalse($this->status->getInitial());
    }

    /**
     * Test getter and setter for Discarded
     */
    public function testSetDiscarded()
    {
        $expected = true;

        self::assertEquals($this->status, $this->status->setDiscarded($expected));
        self::assertTrue($this->status->getDiscarded());

        $expected = false;

        self::assertEquals($this->status, $this->status->setDiscarded($expected));
        self::assertFalse($this->status->getDiscarded());
    }

    /**
     * Test getter and setter for Managed
     */
    public function testSetManaged()
    {
        $expected = true;

        self::assertEquals($this->status, $this->status->setManaged($expected));
        self::assertTrue($this->status->getManaged());

        $expected = false;

        self::assertEquals($this->status, $this->status->setManaged($expected));
        self::assertFalse($this->status->getManaged());
    }

    /**
     * Test getter and setter for Creator
     */
    public function testSetCreator()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->status, $this->status->setCreator($user));
        self::assertEquals($user, $this->status->getCreator());
    }

    /**
     * Test getter and setter for Updater
     */
    public function testSetUpdater()
    {
        $user = new User();
        $user->setUsername('user');

        self::assertEquals($this->status, $this->status->setUpdater($user));
        self::assertEquals($user, $this->status->getUpdater());
    }
}
