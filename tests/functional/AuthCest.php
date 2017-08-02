<?php
namespace Test\AppBundle\Functional;

use \FunctionalTester as FunctionalTester;

class AuthCest
{
    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/login');
        //Menu verification
        $I->see('Sign In', '#navbar-top li.active');
    }
    /**
     * @group user
     * @param FunctionalTester $I
     */
    public function authAsUser(FunctionalTester $I)
    {
        //I fill form
        $I->fillField('Username', 'user1');
        $I->fillField('Password', 'p@ssword');
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
     * @param FunctionalTester $I
     */
    public function authAsAdmin(FunctionalTester $I)
    {
        $I->wantTo('fill login form with admin credentials');
        $I->fillField('Username', 'admin1');
        $I->fillField('Password', 'p@$$word');
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
