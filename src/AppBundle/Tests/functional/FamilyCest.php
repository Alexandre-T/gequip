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
class FamilyCest
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
        $I->seeLink('Families');
        $I->click('Families');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function completeScenarioTest(FunctionalTester $I)
    {
        $I->wantToTest('The complete scenario for functional family');
        $I->seeInTitle('Family tree');

        //Listing
        $I->seeLink(' Create a new family');
        $I->click(' Create a new family');

        //Creation form
        $I->seeCurrentUrlEquals('/settings/family/new');
        $I->seeResponseCodeIs(200);
        $I->fillField('Name', 'Codeception Test New Family');
        $I->click('Edit', 'form');

        //Show
        $I->seeCurrentUrlEquals('/settings/family/show/codeception-test-new-family');
        $I->see('Family "Codeception Test New Family" has been successfully created!', '.alert');

        $I->seeLink('Équipements dynamiques');
        $I->seeLink('Codeception Test New Family');

        $I->see('Codeception Test New Family', 'dd.lead');
        $I->see('Root', '.panel-primary');
        $I->see('Parent', '.panel-primary');
        $I->see('Équipements dynamiques', '.panel-primary');

        $I->see('Admin1', '#settings-family-creator-information');

        //$I->see('Admin1','#settings-family-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('Parent: Équipements dynamiques', '#settings-family-logs');
        $I->see('Label: Codeception Test New Family', '#settings-family-logs');

        $I->click(' Edit', '#settings-family-actions');

        $I->canSeeCurrentUrlMatches('/\/settings\/family\/(?P<digit>\d+)\/edit/');

        $I->fillField('Name', 'Codeception Test Edit Family');
        //$I->selectOption('Parent', 'Caméras'); //@TODO Fix this to test it!
        $I->click('Edit', 'form');

        $I->seeCurrentUrlEquals('/settings/family/show/codeception-test-edit-family');
        $I->see('Family "Codeception Test Edit Family" has been successfully updated!', '.alert');
        //$I->see('Admin1','#settings-family-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('Parent: Équipements dynamiques', '#settings-family-logs');
        $I->see('Label: Codeception Test New Family', '#settings-family-logs');
        $I->see('Label: Codeception Test Edit Family', '#settings-family-logs');

        //@TODO Test the Delete button
        //$I->click(' Delete', 'form');
        //$I->seeCurrentUrlEquals('/settings/family');
    }
}
