<?php
/**
 * This file is part of the GEquip Application.
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

namespace AppBundle\Tests\Bean;

use AppBundle\Bean\Data;
use AppBundle\Bean\Factory\DataFactory;
use AppBundle\Entity\Family;
use PHPUnit\Framework\TestCase;

/**
 * Data Bean Factory test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class DataFactoryTest extends TestCase
{
    /**
     * @var Data
     */
    private $data;

    /**
     * Setup before each unit test.
     */
    protected function setUp()
    {
        $this->data = new Data();
    }

    /**
     * Testing Create Family Data.
     */
    public function testCreateFamilyDataWithOneKey()
    {
        //First case with name
        $rowdata['name'] = 'name';
        $expected = new Data();
        $expected->setLabel('settings.label.name');
        $expected->setName('name');
        $actuals = DataFactory::createFamilyData($rowdata, []);
        self::assertCount(1, $actuals);
        self::compareMethodsResults($expected, $actuals[0]);
        unset($rowdata, $expected, $actuals);

        //Second case No more parent 42
        $rowdata['parent']['id'] = 42;
        $expected = new Data();
        $expected->setEntity('Family');
        $expected->setLabel('settings.label.parent');
        $expected->setId(42);
        $expected->setNoMore(true);
        $actuals = DataFactory::createFamilyData($rowdata, []);
        self::assertCount(1, $actuals);
        self::compareMethodsResults($expected, $actuals[0]);

        //Third case No more parent 42 but some wrong families
        $families[]= $this->createMockFamily(17);
        $families[]= $this->createMockFamily(19);

        $actuals = DataFactory::createFamilyData($rowdata, $families);
        self::assertCount(1, $actuals);
        self::compareMethodsResults($expected, $actuals[0]);
        unset($expected, $actuals);

        //Fourth case No more parent 42 but some wrong families
        $families[]= $this->createMockFamily(17);
        $families[]= $this->createMockFamily(19);
        $families[]= $this->createMockFamily(42);

        $expected = new Data();
        $expected->setLabel('settings.label.parent');
        $expected->setName('Name 42');

        $actuals = DataFactory::createFamilyData($rowdata, $families);
        self::assertCount(1, $actuals);
        self::compareMethodsResults($expected, $actuals[0]);
    }

    /**
     * Testing Create Family Data.
     */
    public function testCreateFamilyDataWithTwoKeys()
    {
        //First case with name
        $rowdata['name'] = 'name';
        $expected[0] = new Data();
        $expected[0]->setLabel('settings.label.name');
        $expected[0]->setName('name');
        $actuals = DataFactory::createFamilyData($rowdata, []);
        self::compareMethodsResults($expected[0], $actuals[0]);
        unset($actuals);

        //Second case No more parent 42
        $rowdata['parent']['id'] = 42;
        $expected[1] = new Data();
        $expected[1]->setEntity('Family');
        $expected[1]->setLabel('settings.label.parent');
        $expected[1]->setId(42);
        $expected[1]->setNoMore(true);
        $actuals = DataFactory::createFamilyData($rowdata, []);
        self::compareMethodsResults($expected[0], $actuals[0]);
        self::compareMethodsResults($expected[1], $actuals[1]);
        unset($actuals);

        //Third case No more parent 42 but some wrong families
        $families[]= $this->createMockFamily(17);
        $families[]= $this->createMockFamily(19);

        $actuals = DataFactory::createFamilyData($rowdata, $families);
        self::assertCount(2, $actuals);
        self::compareMethodsResults($expected[0], $actuals[0]);
        self::compareMethodsResults($expected[1], $actuals[1]);
        unset($expected[1], $actuals);

        //Fourth case No more parent 42 but some wrong families
        $families[]= $this->createMockFamily(17);
        $families[]= $this->createMockFamily(19);
        $families[]= $this->createMockFamily(42);

        $expected[1] = new Data();
        $expected[1]->setLabel('settings.label.parent');
        $expected[1]->setName('Name 42');

        $actuals = DataFactory::createFamilyData($rowdata, $families);
        self::assertCount(2, $actuals);
        self::compareMethodsResults($expected[0], $actuals[0]);
        self::compareMethodsResults($expected[1], $actuals[1]);
    }

    /**
     * Testing unverifiedFamily private method with an empty Array.
     */
    public function testUnverifiedFamilyWithEmptyArray()
    {
        self::expectExceptionMessage('Log array must have a parent or a name key. There is no key in this one.');
        $reflectionClass = new \ReflectionClass(DataFactory::class);
        $method = $reflectionClass->getMethod('unverifiedFamily');
        $method->setAccessible(true);
        $method->invoke($reflectionClass, []);
    }

    /**
     * Testing unverifiedFamily private method with an array with one unvalid key.
     */
    public function testUnverifiedFamilyWithOneWrongKey()
    {
        self::expectExceptionMessage('Log array must have a parent or a name key. The key is not valid.');
        $reflectionClass = new \ReflectionClass(DataFactory::class);
        $method = $reflectionClass->getMethod('unverifiedFamily');
        $method->setAccessible(true);
        $method->invoke($reflectionClass, ['toto' => 42]);
    }

    /**
     * Testing unverifiedFamily private method with an array with one unvalid key.
     */
    public function testUnverifiedFamilyWithOneWrongOfTwoKeys()
    {
        self::expectExceptionMessage('Log array must have a parent or a name key. At least, one of the two keys is not valid.');
        $reflectionClass = new \ReflectionClass(DataFactory::class);
        $method = $reflectionClass->getMethod('unverifiedFamily');
        $method->setAccessible(true);
        $method->invoke($reflectionClass, ['parent' => 'p', 'toto' => 42]);
    }

    /**
     * Testing unverifiedFamily private method with an array with one unvalid key.
     */
    public function testUnverifiedFamilyWithOneWrongOfTwoKeys2()
    {
        self::expectExceptionMessage('Log array must have a parent or a name key. At least, one of the two keys is not valid.');
        $reflectionClass = new \ReflectionClass(DataFactory::class);
        $method = $reflectionClass->getMethod('unverifiedFamily');
        $method->setAccessible(true);
        $method->invoke($reflectionClass, ['name' => 'n', 'toto' => 42]);
    }

    /**
     * Testing unverifiedFamily private method with an array with one unvalid key.
     */
    public function testUnverifiedFamilyWithTwoWrongKeys()
    {
        self::expectExceptionMessage('Log array must have a parent or a name key. At least, one of the two keys is not valid.');
        $reflectionClass = new \ReflectionClass(DataFactory::class);
        $method = $reflectionClass->getMethod('unverifiedFamily');
        $method->setAccessible(true);
        $method->invoke($reflectionClass, ['beep' => 'p', 'toto' => 42]);
    }

    /**
     * This test compare the result of each method.
     *
     * Because we aren't comparing two object of different instance,
     * we compare the result of each method.
     *
     * @param Data $expected
     * @param Data $actual
     */
    private static function compareMethodsResults(Data $expected, Data $actual)
    {
        self::assertEquals($expected->getEntity(), $actual->getEntity());
        self::assertEquals($expected->getId(), $actual->getId());
        self::assertEquals($expected->getLabel(), $actual->getLabel());
        self::assertEquals($expected->getName(), $actual->getName());
        self::assertEquals($expected->isNoMore(), $actual->isNoMore());
        self::assertEquals($expected->isNone(), $actual->isNone());
    }

    /**
     * Create a Mock of Family.
     *
     * @param int $id
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function createMockFamily(int $id)
    {
        $family = $this->getMockBuilder(Family::class)->getMock();
        $family->method('getId')->willReturn($id);
        $family->method('getName')->willReturn("Name $id");

        return $family;
    }
}
