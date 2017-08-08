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

namespace AppBundle\Tests\Bean;

use AppBundle\Bean\Log;
use PHPUnit\Framework\TestCase;

/**
 * Log Bean test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class LogTest extends TestCase
{
    /**
     * @var Log
     */
    private $log;

    /**
     * Setup before each unit test.
     */
    protected function setUp()
    {
        $this->log = new Log();
    }

    /**
     * Testing Base::constructor.
     */
    public function testConstructor()
    {
        //No null value for a bean
        self::assertNotNull($this->log->getAction());
        self::assertNotNull($this->log->getUsername());
        self::assertFalse($this->log->isLogged());
        self::assertFalse($this->log->hasVersion());

        //Default value test
        self::assertEmpty($this->log->getVersion());
        self::assertEmpty($this->log->getAction());
        self::assertEmpty($this->log->getUsername());
        self::assertCount(0, $this->log->getData());
    }

    /**
     * Testing getter and setter of Version.
     */
    public function testVersion()
    {
        self::assertFalse($this->log->hasVersion());
        $expected = 42;
        self::assertEquals($this->log, $this->log->setVersion($expected));
        self::assertEquals($expected, $this->log->getVersion());
        self::assertTrue($this->log->hasVersion());

        $expected = 0;
        self::assertEquals($this->log, $this->log->setVersion($expected));
        self::assertEquals($expected, $this->log->getVersion());
        self::assertFalse($this->log->hasVersion());
    }

    /**
     * Testing getter and setter of Action.
     */
    public function testAction()
    {
        $expected = 'action';
        self::assertEquals($this->log, $this->log->setAction($expected));
        self::assertEquals($expected, $this->log->getAction());
    }

    /**
     * Testing getter and setter of Username.
     */
    public function testUsername()
    {
        $expected = 'username';
        self::assertEquals($this->log, $this->log->setUsername($expected));
        self::assertEquals($expected, $this->log->getUsername());

        $expected = '';
        self::assertEquals($this->log, $this->log->setUsername(null));
        self::assertEquals($expected, $this->log->getUsername());
    }

    /**
     * Testing getter and setter of Logged.
     */
    public function testLogged()
    {
        self::assertFalse($this->log->isLogged());
        $expected = new \DateTime();
        self::assertEquals($this->log, $this->log->setLogged($expected));
        self::assertEquals($expected, $this->log->getLogged());
        self::asserttrue($this->log->isLogged());
    }
}
