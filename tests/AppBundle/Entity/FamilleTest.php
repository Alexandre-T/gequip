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

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Famille;
use PHPUnit\Framework\TestCase;

/**
 * Famille Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class FamilleTest extends TestCase
{
    /**
     * @var Famille
     */
    private $famille;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->famille = new Famille();
    }

    /**
     * All value must be null after creation
     */
    public function testConstructor(){
        self::assertNull($this->famille->getId());
        self::assertNull($this->famille->getChildren());
        self::assertNull($this->famille->getLeft());
        self::assertNull($this->famille->getLevel());
        self::assertNull($this->famille->getName());
        self::assertNull($this->famille->getParent());
        self::assertNull($this->famille->getRight());
        self::assertNull($this->famille->getRoot());
    }

    /**
     * Test getter and setter for Name
     */
    public function testSetName(){
        $expected = 'name';

        self::assertEquals($this->famille, $this->famille->setName($expected));
        self::assertEquals($expected, $this->famille->getName());
    }

    /**
     * Test getter and setter for Parent
     */
    public function testSetParent(){
        $parent = new Famille();
        $parent->setName('parent');

        self::assertEquals($this->famille, $this->famille->setParent($parent));
        self::assertEquals($parent, $this->famille->getParent());
    }
}
