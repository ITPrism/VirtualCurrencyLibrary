<?php
/**
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Transaction
 * @author      Todor Iliev
 * @copyright   Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

use Virtualcurrency\Transaction\Transaction;

/**
 * Test class for Virtualcurrency\Transaction.
 *
 * @package     Virtualcurrency\UnitTest
 * @subpackage  Transaction
 */
class TransactionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Transaction
     */
    protected $object;

    /**
     * Test the getExtraData method.
     *
     * @return  void
     * @covers  Transaction::getExtraData
     */
    public function testGetExtraData()
    {
        $this->assertEquals(
            [],
            $this->object->getExtraData()
        );
    }

    /**
     * Test the addExtraData method.
     *
     * @return  void
     * @covers  Transaction::addExtraData
     */
    public function testAddExtraData()
    {
        $extraData = [
            'token' => '123456'
        ];

        // It is not possible to decrease with higher number than already exists.
        $this->object->addExtraData($extraData);
        $this->assertEquals(
            $extraData,
            $this->object->getExtraData()
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

        $data = file_get_contents($dataPath.'transaction.json');
        $data = json_decode($data, true);

        $this->object = new Transaction;
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
