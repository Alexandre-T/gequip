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

namespace AppBundle;
use AppBundle\FunctionalTester;

/**
 * Firewall Functional Codeception Test.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class AuthCest
{
    /**
     * Before each test!
     *
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        //Menu verification
        $I->seeInTitle('Log in');
    }
    /**
     * @group user
     * @param FunctionalTester $I
     */
    public function authAsUser(FunctionalTester $I)
    {
        //I fill form
        $I->fillField('Username', 'user1');
        $I->fillField('Password', 'password');
        $I->click('Log in');

        $I->wantTo('verify that the admin menu is hidden');
        $I->seeCurrentUrlEquals('/');
        $I->seeLink('Logout');
        $I->dontSeeLink('All settings');
        $I->dontSeeLink('Sign In');
        $I->dontSeeLink('Sign in');

        $I->wantTo('verify that a direct access to settings page will be denied by firewall');
        $I->expect("Standard users can't access settings area");
        $I->amOnPage('/settings/');
        $I->seeResponseCodeIs(403);
    }
    /**
     * @param FunctionalTester $I
     */
    public function authAsAdmin(FunctionalTester $I)
    {
        $I->wantTo('fill login form with admin credentials');
        $I->fillField('Username', 'admin1');
        $I->fillField('Password', 'password');
        $I->click('Log in');

        $I->wantTo('go to settings index');
        $I->seeCurrentUrlEquals('/');
        $I->seeLink('Logout');
        $I->click('All settings');

        $I->seeCurrentUrlEquals('/settings');
        $I->see('Settings', '#navbar-top li.active');
        $I->see('All settings', '#navbar-top li.active');
        $I->seeResponseCodeIs(200);
        $I->seeLink('Logout');
        $I->see('Families', 'a.lead');
    }
    /**
     * @param FunctionalTester $I
     */
    public function invalidAuth(FunctionalTester $I)
    {
        $I->wantTo('fill login form with invalid credentials');
        $I->fillField('Username', 'notauser');
        $I->fillField('Password', 'kitten');
        $I->click('Log in');
        $I->wantTo('verify that connection has been refused');
        $I->see('Invalid credentials', '.alert');
        $I->seeInCurrentUrl('/login');
        $I->seeLink('Sign In');
        $I->dontSeeLink('Logout');
    }

}
