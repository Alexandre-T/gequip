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

use AppBundle\Bean\Information;
use PHPUnit\Framework\TestCase;

/**
 * Information Bean test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class InformationTest extends TestCase
{
    /**
     * @var Information
     */
    private $information;

    /**
     * Setup before each unit test.
     */
    protected function setUp()
    {
        $this->information = new Information();
    }

    /**
     * Testing Base::constructor.
     */
    public function testConstructor()
    {
        //No null value for a bean
        self::assertNotNull($this->information->getCreator());
        self::assertNotNull($this->information->getUpdater());
        self::assertFalse($this->information->isCreated());
        self::assertFalse($this->information->isUpdated());

        //Default value test
        self::assertEmpty($this->information->getCreator());
        self::assertEmpty($this->information->getUpdater());
    }
    
    /**
     * Testing getter and setter of Creator.
     */
    public function testCreator()
    {
        $expected = 'creator';
        self::assertEquals($this->information, $this->information->setCreator($expected));
        self::assertEquals($expected, $this->information->getCreator());
        self::assertTrue($this->information->hasCreator());

        $expected = '';
        self::assertEquals($this->information, $this->information->setCreator(null));
        self::assertEquals($expected, $this->information->getCreator());
        self::assertFalse($this->information->hasCreator());
    }

    /**
     * Testing getter and setter of Updater.
     */
    public function testUpdater()
    {
        $expected = 'updater';
        self::assertEquals($this->information, $this->information->setUpdater($expected));
        self::assertEquals($expected, $this->information->getUpdater());
        self::assertTrue($this->information->hasUpdater());

        $expected = '';
        self::assertEquals($this->information, $this->information->setUpdater(null));
        self::assertEquals($expected, $this->information->getUpdater());
        self::assertFalse($this->information->hasUpdater());
    }

    /**
     * Testing getter and setter of Updated.
     */
    public function testUpdated()
    {
        self::assertFalse($this->information->isUpdated());
        $expected = new \DateTime();
        self::assertEquals($this->information, $this->information->setUpdated($expected));
        self::assertEquals($expected, $this->information->getUpdated());
        self::asserttrue($this->information->isUpdated());
    }

    /**
     * Testing getter and setter of Created.
     */
    public function testCreated()
    {
        self::assertFalse($this->information->isCreated());
        $expected = new \DateTime();
        self::assertEquals($this->information, $this->information->setCreated($expected));
        self::assertEquals($expected, $this->information->getCreated());
        self::asserttrue($this->information->isCreated());
    }
}
