<?php


class HomepageCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        //Home Page
        $I->amOnPage('/');

        // I see the title
        $I->see('G-Equip','h1');

        //Menu verification
        $I->see('Home', '#navbar-top li.active');

        //User menu verification
        $I->see('Sign In', '#navbar-top ul.navbar-right li.first');
        $I->see('Sign Up', '#navbar-top ul.navbar-right li.last');
    }
}
