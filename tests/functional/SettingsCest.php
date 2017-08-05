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
namespace Test\AppBundle\Functional;

use \FunctionalTester as FunctionalTester;

/**
 * Settings Functional Codeception Test.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class SettingsCest
{
    /**
     * Before each test!
     *
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('Username','admin1');
        $I->fillField('Password', 'password');
        $I->click('Log in');
        $I->see('admin1');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function roleAdminTest(FunctionalTester $I)
    {

        $I->wantToTest('Firewall for ROLE_ADMIN');
        $I->amOnPage('/settings');
        $I->seeInTitle('Settings');
        $I->seeCurrentUrlEquals('/settings');
        $I->seeResponseCodeIs(200);
    }
}
