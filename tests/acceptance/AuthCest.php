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

namespace Test\AppBundle\Acceptance;

use \AcceptanceTester as AcceptanceTester;

/**
 * Homepage Acceptance Codeception Test.
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
     * @param AcceptanceTester $I
     */
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        //Menu verification
        $I->see('Sign In', '#navbar-top li.active');
    }
    /**
     * @group user
     * @param AcceptanceTester $I
     */
    public function authAsUser(AcceptanceTester $I)
    {
        //I fill form
        $I->fillField('Username', 'user1');
        $I->fillField('Password', 'password');
        $I->click('Log in');

        $I->wantTo('verify that the admin menu is hidden');
        $I->seeCurrentUrlEquals('/');
        $I->see('Home', '#navbar-top li.active');
        $I->seeLink('Logout');
        $I->dontSeeLink('All settings');

        $I->wantTo('verify that a direct access to settings page will be denied by firewall');
        $I->seeCurrentUrlEquals('/');
        $I->seeLink('Logout');
        $I->expect("Standard users can't access settings area");
        $I->amOnPage('/settings/');
        $I->seeResponseCodeIs(403);
    }
    /**
     * @param AcceptanceTester $I
     */
    public function authAsAdmin(AcceptanceTester $I)
    {
        $I->wantTo('fill login form with admin credentials');
        $I->fillField('Username', 'admin1');
        $I->fillField('Password', 'password');
        $I->click('Log in');

        $I->wantTo('go to settings index');
        $I->seeCurrentUrlEquals('/');
        $I->see('Home', '#navbar-top li.active');
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
     * @param AcceptanceTester $I
     */
    public function invalidAuth(AcceptanceTester $I)
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
