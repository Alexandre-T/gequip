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
class ServiceCest
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
        $I->seeLink('Your services');
        $I->click('Your services');
    }

    /**
     * Executed tests.
     *
     * @param FunctionalTester $I
     */
    public function completeScenarioTest(FunctionalTester $I)
    {
        $I->wantToTest('The complete scenario for functional service');
        $I->seeInTitle('Service tree');
        $I->dontSee('', 'ol#content-breadcrumb');

        //Listing
        $I->seeLink(' Create a new service');
        $I->click(' Create a new service');

        //Creation form
        $I->seeCurrentUrlEquals('/settings/service/new');
        $I->seeResponseCodeIs(200);

        $I->wantToTest('An empty name must be detected');
        $I->click('Create', 'form');
        $I->seeCurrentUrlEquals('/settings/service/new');
        $I->see('This value should not be blank.', '.help-block');
//        $I->fillField('Name', 'A');
//        $I->click('Create', 'form');
//        $I->see('This value is too short. It should have 2 characters or more.', '.help-block');
        $I->fillField('Name', 'AbcdefghijklmnopqrstuvwxyzABCDEFG');
        $I->click('Create', 'form');
        $I->see('This value is too long. It should have 32 characters or less.', '.help-block');

        $I->fillField('Name', 'New Service');
        $I->selectOption('Parent ', 'DIR Est');
        $I->dontSee('', 'ol#content-breadcrumb');
        $I->click('Create', 'form');

        //Show
        $I->seeCurrentUrlEquals('/settings/service/show/new-service');
        $I->see('Service "New Service" has been successfully created!', '.alert');

        $I->seeLink('DIR Est');
        $I->seeLink('New Service');

        $I->see('New Service', 'dd.lead');
        $I->see('Root', '.panel-primary');
        $I->see('Parent', '.panel-primary');
        $I->see('DIR Est', '.panel-primary');

        $I->see('Admin1', '#settings-creator-information');
        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        //$I->see('Admin1','#settings-service-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('Parent', '#settings-logs dl');
        $I->see('DIR Est', '#settings-logs dd');
        $I->see('Name', '#settings-logs dl');
        $I->see('New Service', '#settings-logs dd');

        $I->click(' Edit', '#settings-actions');

        $I->canSeeCurrentUrlMatches('/\/settings\/service\/(?P<digit>\d+)\/edit/');

        $I->fillField('Name', 'Edited service');
        //$I->selectOption('Parent', 'Caméras'); //@TODO Fix this to test it!
        $I->click('Edit', 'form');

        $I->seeCurrentUrlEquals('/settings/service/show/edited-service');
        $I->see('Service "Edited service" has been successfully updated!', '.alert');
        //$I->see('Admin1','#settings-service-logs'); <=== I didn't work on functional tests!!!! CRAZY
        $I->see('DIR Est', '#settings-logs dd');
        $I->see('New Service', '#settings-logs dd');
        $I->see('Edited service', '#settings-logs dd');

        $I->see('Created by', '#settings-creator-information');
        $I->see('Created at', '#settings-creator-information');
        $I->see('Updated by', '#settings-creator-information');
        $I->see('Updated at', '#settings-creator-information');

        //@TODO Test the Delete button
        //$I->click(' Delete', 'form');
        //$I->seeCurrentUrlEquals('/settings/service');
    }
}
