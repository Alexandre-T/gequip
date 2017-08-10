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

/**
 * Homepage Functional Codeception Test.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class StatusCest
{
    /**
     * Before each test!
     *
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $I->wantTo('Be an admin');
        $I->amOnPage('/login');
        $I->fillField('Username', 'admin1');
        $I->fillField('Password', 'password');
        $I->click('Log in');
        //$I->am('ROLE_ADMIN');
        $I->seeLink('Status');
        $I->click('Status');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function completeScenarioTest(FunctionalTester $I)
    {
        $I->wantToTest('The complete scenario for functional status');
        $I->seeInTitle('Listing of status');
        $I->dontSee('', 'ol#content-breadcrumb');

        //Listing
        $I->seeLink('Create a new status');
        $I->click('Create a new status');

        //Creation form
        $I->seeCurrentUrlEquals('/settings/status/new');
        $I->seeResponseCodeIs(200);

        $I->wantToTest('An empty name must be detected');
        $I->click('Create', 'form');
        $I->seeCurrentUrlEquals('/settings/status/new');
        $I->see('This value should not be blank.', '.help-block');
        $I->wantToTest('An too long name must be detected');
        $I->fillField('Name', 'Abcdefghijklmnopqrstuvwxyz');
        $I->click('Create', 'form');
        $I->see('This value is too long. It should have 16 characters or less.', '.help-block');

        $I->fillField('Name', 'New Status');
        $I->dontSee('', 'ol#content-breadcrumb');
        $I->click('Create', 'form');

        //Show
        $I->canSeeCurrentUrlMatches('/\/settings\/status\/(?P<digit>\d+)/');
        $I->see('Status "New Status" has been successfully created!', '.alert');

//        $I->seeLink('Équipements dynamiques');
//        $I->seeLink('New Status');

        $I->see('New Status', 'dd.lead');
        $I->see('No', '.panel-primary dd');

        $I->see('Admin1', '#settings-creator-information');
        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->see('Initial', '#settings-logs dl');
        $I->see('Calendar managed', '#settings-logs dl');
        $I->see('Discarded', '#settings-logs dl');
        $I->see('Name', '#settings-logs dl');
        $I->see('Description', '#settings-logs dl');
        $I->see('New Status', '#settings-logs dd');

        $I->click(' Edit', '#settings-actions');

        $I->canSeeCurrentUrlMatches('/\/settings\/status\/(?P<digit>\d+)\/edit/');

        $I->fillField('Name', 'Edited Status');
        //$I->selectOption('Parent', 'Caméras'); //@TODO Fix this to test it!
        $I->click('Edit', 'form');

        $I->canSeeCurrentUrlMatches('/\/settings\/status\/(?P<digit>\d+)/');
        $I->see('Status "Edited Status" has been successfully updated!', '.alert');
        //$I->see('Admin1','#settings-status-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('New Status', '#settings-logs dd');
        $I->see('Edited Status', '#settings-logs dd');

        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->click (' Back to the list');
        $I->seeCurrentUrlEquals('/settings/status/');
        $I->see('Edited Status', 'table.table td');

        //@TODO Test the Delete button
        //$I->click(' Delete', 'form');
        //$I->seeCurrentUrlEquals('/settings/status');
    }
}
