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
class AxeCest
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
        $I->seeLink('Axes');
        $I->click('Axes');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function completeScenarioTest(FunctionalTester $I)
    {
        $I->wantToTest('The complete scenario for functional axe');
        $I->seeInTitle('Listing of axes');
        $I->dontSee('', 'ol#content-breadcrumb');

        //Listing
        $I->seeLink('Create a new axe');
        $I->click('Create a new axe');

        //Creation form
        $I->seeCurrentUrlEquals('/settings/axe/new');
        $I->seeResponseCodeIs(200);

        $I->wantToTest('An empty name must be detected');
        $I->click('Create', 'form');
        $I->seeCurrentUrlEquals('/settings/axe/new');
        $I->see('This value should not be blank.', '.help-block');
        $I->wantToTest('A too long name must be detected');
        $I->fillField('Name', 'Abcdefghijklmnopqrstuvwxyz');
        $I->click('Create', 'form');
        $I->see('This value is too long. It should have 16 characters or less.', '.help-block');

        $I->wantToTest('A too long code must be detected');
        $I->fillField('Code', 'Abcdefghi');
        $I->click('Create', 'form');
        $I->see('This value is too long. It should have 8 characters or less.', '.help-block');

        $I->fillField('Name', 'New Axe');
        $I->fillField('Code', 'Alpha');
        $I->click('Create', 'form');

        //Show
        $id = $I->grabFromCurrentUrl('~(\d+)~');
        var_dump($id);
        $I->canSeeCurrentUrlMatches('/\/settings\/axe\/(?P<digit>\d+)/');
        $I->see('Axe "New Axe" has been successfully created!', '.alert');

        $I->see('New Axe', 'dd.lead');
        $I->see('Alpha', '.panel-primary dd');

        $I->wantToTest('I see all creation and updates information');
        $I->see('Admin1', '#settings-creator-information');
        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->see('Code', '#settings-logs dl');
        $I->see('Alpha', '#settings-logs dd');
        $I->see('Name', '#settings-logs dl');
        $I->see('New Axe', '#settings-logs dd');

        $I->click(' Edit', '#settings-actions');

        $I->canSeeCurrentUrlMatches('/\/settings\/axe\/(?P<digit>\d+)\/edit/');

        $I->fillField('Name', 'Edited Axe');
        $I->click('Edit', 'form');

        $I->canSeeCurrentUrlMatches('/\/settings\/axe\/(?P<digit>\d+)/');
        $I->see('Axe "Edited Axe" has been successfully updated!', '.alert');
        $I->see('New Axe', '#settings-logs dd');
        $I->see('Edited Axe', '#settings-logs dd');

        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        $I->click(' Back to the list');
        $I->seeCurrentUrlEquals('/settings/axe/');
        $I->see('Edited Axe', 'table.table td');

        $I->wantToTest("Delete route is not open for a GET Request");
        $I->amOnRoute('settings_axe_delete', array('id' => $id));
        $I->seeCurrentUrlEquals("/settings/axe/$id");
        //@TODO Test the Delete button
    }
}
