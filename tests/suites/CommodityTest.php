<?php
/**
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Commodity
 * @author      Todor Iliev
 * @copyright   Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

use Virtualcurrency\Commodity\Commodity;

/**
 * Test class for Virtualcurrency\Commodity.
 *
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Commodity
 */
class CommodityTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Commodity
     */
    protected $object;

    /**
     * Test the decreaseInStock method.
     *
     * @return  void
     * @covers  Commodity::decreaseInStock
     */
    public function testDecreaseInStock()
    {
        // It is not possible to decrease with higher number than already exists.
        $this->object->decreaseInStock(50);
        $this->assertEquals(
            10,
            $this->object->getInStock()
        );

        $this->object->decreaseInStock(5);
        $this->assertEquals(
            5,
            $this->object->getInStock()
        );

        $this->object->decreaseInStock(5);
        $this->assertEquals(
            0,
            $this->object->getInStock()
        );
    }

    /**
     * Test the hasUnits method.
     *
     * @return  void
     * @covers  Commodity::hasUnits
     */
    public function testHasUnits()
    {
        $this->assertTrue(
            $this->object->hasUnits(10),
            'There are enough units. We are looking for 10 units (in stock 10).'
        );

        $this->assertTrue(
            $this->object->hasUnits(5),
            'There are NOT enough units. We are looking for 5 units (in stock 10).'
        );

        $this->assertFalse(
            $this->object->hasUnits(20),
            'There are NOT enough units. We are looking for 20 units (in stock 10).'
        );

        $this->object->setInStock(-1);
        $this->assertTrue(
            $this->object->hasUnits(1000),
            'There are NOT enough units. We are looking for 1000 units (in stock -1 | UNLIMITED).'
        );
    }

    /**
     * Test the calculateRealPrice method.
     *
     * @return  void
     * @covers  Commodity::calculateRealPrice
     */
    public function testCalculateRealPrice()
    {
        $numberOfUnits = 10;

        // Price for a unit 10.00.
        $realPrice     = $this->object->calculateRealPrice($numberOfUnits);

        $this->assertEquals(
            1000.00,
            $realPrice
        );
    }

    /**
     * Test the calculateVirtualPrice method.
     *
     * @return  void
     * @covers  Commodity::calculateVirtualPrice
     */
    public function testCalculateVirtualPrice()
    {
        $numberOfUnits = 10;

        // Price for a unit 100.00.
        $virtualPrice  = $this->object->calculateVirtualPrice($numberOfUnits);

        $this->assertEquals(
            10.00,
            $virtualPrice
        );
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return  void
     */
    protected function setUp()
    {
        parent::setUp();

        $dataPath = str_replace('suites', 'stubs'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR, __DIR__);

        $data = file_get_contents($dataPath.'commodity.json');
        $data = json_decode($data, true);

        $this->object = new Commodity;
        $this->object->bind($data);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     *
     * @see     PHPUnit_Framework_TestCase::tearDown()
     */
    protected function tearDown()
    {
        unset($this->object);
        parent::tearDown();
    }
}
