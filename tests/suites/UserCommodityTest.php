<?php
/**
 * @package     Virtualcurrency\UnitTest
 * @subpackage  User\Commodity
 * @author      Todor Iliev
 * @copyright   Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

use Virtualcurrency\User\Commodity\Commodity;

/**
 * Test class for Virtualcurrency\Commodity.
 *
 * @package     Virtualcurrency\UnitTest
 * @subpackage  User\Commodity
 */
class UserCommodityTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Commodity
     */
    protected $object;

    /**
     * Test the increaseNumber method.
     *
     * @return  void
     * @covers  Commodity::increaseNumber
     */
    public function testIncreaseNumber()
    {
        $this->object->increaseNumber(5);
        $this->assertEquals(
            15,
            $this->object->getNumber()
        );
    }

    /**
     * Test the decreaseNumber method.
     *
     * @return  void
     * @covers  Commodity::decreaseNumber
     */
    public function testDecreaseNumber()
    {
        // It is not possible to decrease with higher number than already exists.
        $this->object->decreaseNumber(50);
        $this->assertEquals(
            10,
            $this->object->getNumber()
        );

        $this->object->decreaseNumber(5);
        $this->assertEquals(
            5,
            $this->object->getNumber()
        );

        $this->object->decreaseNumber(5);
        $this->assertEquals(
            0,
            $this->object->getNumber()
        );
    }

    /**
     * Test the getCommodity method.
     *
     * @return  void
     * @covers  Commodity::getCommodity
     */
    public function testGetCommodity()
    {
        $this->assertInstanceOf(
            Virtualcurrency\Commodity\Commodity::class,
            $this->object->getCommodity()
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

        $data = file_get_contents($dataPath.'user_commodity.json');
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
