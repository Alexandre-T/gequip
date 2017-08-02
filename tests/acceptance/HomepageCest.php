<?php
/**
 * This file is part of the G-Equip Application.
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

/**
 * Homepage Acceptance Test.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class HomepageCest
{
    /**
     * Test Homepage and connexion with user "user1".
     *
     * @param AcceptanceTester $I
     */
    public function tryToTest(AcceptanceTester $I)
    {
        //Home Page
        $I->amOnPage('/');

        // I see the title
        $I->see('G-Equip', 'h1');

        //Menu verification
        $I->see('Home', '#navbar-top li.active');
    }
}
