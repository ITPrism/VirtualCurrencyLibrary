<?php
/**
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Account
 * @author      Todor Iliev
 * @copyright   Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

use Virtualcurrency\Account\Account;

/**
 * Test class for Virtualcurrency\Account.
 *
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Account
 */
class AccountTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Account
     */
    protected $object;

    /**
     * Test the increaseAmount method.
     *
     * @return  void
     * @covers  Account::increaseAmount
     */
    public function testIncreaseAmount()
    {
        $this->object->increaseAmount(100);

        $this->assertEquals(
            200.00,
            $this->object->getAmount()
        );
    }

    /**
     * Test the decreaseAmount method.
     *
     * @return  void
     * @covers  Account::decreaseAmount
     */
    public function testDecreaseAmount()
    {
        $this->object->decreaseAmount(50);

        $this->assertEquals(
            50.00,
            $this->object->getAmount()
        );
    }

    /**
     * Test the calculateRealPrice method.
     *
     * @return  void
     * @covers  Account::calculateRealPrice
     */
    public function testCalculateRealPrice()
    {
        $numberOfUnits = 10;

        // Price for a unit 10.00.
        $realPrice     = $this->object->calculateRealPrice($numberOfUnits);

        $this->assertEquals(
            100.00,
            $realPrice
        );
    }

    /**
     * Test the calculateVirtualPrice method.
     *
     * @return  void
     * @covers  Account::calculateVirtualPrice
     */
    public function testCalculateVirtualPrice()
    {
        $numberOfUnits = 10;

        // Price for a unit 1000.00.
        $virtualPrice  = $this->object->calculateVirtualPrice($numberOfUnits);

        $this->assertEquals(
            1000.00,
            $virtualPrice
        );
    }

    /**
     * Test the calculateVirtualPrice method.
     *
     * @return  void
     * @covers  Account::calculateVirtualPrice
     */
    public function testGetCurrency()
    {
        $currency  = $this->object->getCurrency();

        $this->assertInstanceOf(\Virtualcurrency\Currency\Currency::class, $currency);
        $this->assertEquals(
            'GOLD',
            $currency->getCode()
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

        $data = file_get_contents($dataPath.'account.json');
        $data = json_decode($data, true);

        $this->object = new Account;
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
