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

namespace Tests\AppBundle\Menu;

use AppBundle\Menu\Main;
use PHPUnit\Framework\TestCase;

/**
 * User Menu test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class MainTest extends TestCase
{
    /**
     * @var Main
     */
    private $main;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->main = new Main();
    }

    /**
     * Test root menu
     */
    public function testMainMenu()
    {
        self::markTestSkipped('Main menu has to be tested');
    }

    /**
     * Test user menu
     */
    public function testUserMenu()
    {
        self::markTestSkipped('User menu has to be tested');
    }

    /**
     * Test footer menu
     */
    public function testFooterMenu()
    {
        self::markTestSkipped('Footer menu has to be tested');
    }
}
