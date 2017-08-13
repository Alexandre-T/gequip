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
class CriticityCest
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
        $I->seeLink('Criticities');
        $I->click('Criticities');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function completeScenarioTest(FunctionalTester $I)
    {
        $I->wantToTest('The complete scenario for functional criticity');
        $I->seeInTitle('Listing of criticities');
        $I->dontSee('', 'ol#content-breadcrumb');

        //Listing
        $I->seeLink('Create a new criticity');
        $I->click('Create a new criticity');

        //Creation form
        $I->seeCurrentUrlEquals('/settings/criticity/new');
        $I->seeResponseCodeIs(200);

        $I->wantToTest('An empty name must be detected');
        $I->click('Create', 'form');
        $I->seeCurrentUrlEquals('/settings/criticity/new');
        $I->see('This value should not be blank.', '.help-block');
        $I->wantToTest('An too long name must be detected');
        $I->fillField('Name', 'Abcdefghijklmnopqrstuvwxyz');
        $I->click('Create', 'form');
        $I->see('This value is too long. It should have 16 characters or less.', '.help-block');

        $I->wantToTest('A bad period is detected');
        $I->fillField('Name', 'New Criticity');
        $I->fillField('Intervention max time', 'Alpha');
        $I->fillField('Recovery max time', 'New Beta');
        $I->fillField('Average working time ', 'Gamma');
        $I->click('Create', 'form');
        $I->see('This value is not a valid period format', '.help-block');

        $I->fillField('Name', 'New Criticity');
        $I->fillField('Intervention max time', 'P1D');
        $I->fillField('Recovery max time', 'P1W');
        $I->fillField('Average working time ', 'P1Y');
        $I->click('Create', 'form');

        //Show
        $I->canSeeCurrentUrlMatches('/\/settings\/criticity\/(?P<digit>\d+)/');
        $I->see('Criticity "New Criticity" has been successfully created!', '.alert');

        $I->see('New Criticity', 'dd.lead');
        $I->see('P1D', '.panel-primary dd');
        $I->see('P1W', '.panel-primary dd');
        $I->see('P1Y', '.panel-primary dd');

        $I->wantToTest('I see all creation and updates information');
        $I->see('Admin1', '#settings-creator-information');
        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->see('Recovery', '#settings-logs dl');
        $I->see('Working', '#settings-logs dl');
        $I->see('Intervention', '#settings-logs dl');
        $I->see('Name', '#settings-logs dl');
        $I->see('New Criticity', '#settings-logs dd');

        $I->click(' Edit', '#settings-actions');

        $I->canSeeCurrentUrlMatches('/\/settings\/criticity\/(?P<digit>\d+)\/edit/');

        $I->fillField('Name', 'Edited Criticity');
        $I->click('Edit', 'form');

        $I->canSeeCurrentUrlMatches('/\/settings\/criticity\/(?P<digit>\d+)/');
        $I->see('Criticity "Edited Criticity" has been successfully updated!', '.alert');
        //$I->see('Admin1','#settings-criticity-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('New Criticity', '#settings-logs dd');
        $I->see('Edited Criticity', '#settings-logs dd');

        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->click(' Back to the list');
        $I->seeCurrentUrlEquals('/settings/criticity/');
        $I->see('Edited Criticity', 'table.table td');

        //@TODO Test the Delete button
        //$I->click(' Delete', 'form');
        //$I->seeCurrentUrlEquals('/settings/criticity');
    }
}
