<?php
/**
 * @package      Virtualcurrency
 * @subpackage   RealCurrencies
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\RealCurrency;

use Prism\Domain;
use Virtualcurrency\RealCurrency\Gateway\JoomlaGateway;

/**
 * This class provides a glue between persistence layer and currency object.
 *
 * @package      Virtualcurrency
 * @subpackage   RealCurrencies
 */
class Repository extends Domain\Repository implements Domain\CollectionFetcher
{
    /**
     * @var JoomlaGateway
     */
    protected $gateway;

    /**
     * Collection object.
     *
     * @var Domain\Collection
     */
    protected $collection;

    /**
     * Initialize the object.
     *
     * @param Mapper $mapper
     */
    public function __construct(Mapper $mapper)
    {
        $this->mapper  = $mapper;
        $this->gateway = $mapper->getGateway();
    }

    /**
     * Load the data from database and return an entity.
     *
     * <code>
     * $currencyId  = 1;
     *
     * $gateway     = new Virtualcurrency\RealCurrency\Gateway\JoomlaGateway(\JFactory::getDbo());
     * $mapper      = new Virtualcurrency\RealCurrency\Mapper($gateway);
     * $repository  = new Virtualcurrency\RealCurrency\Repository($mapper);
     *
     * $currency    = $repository->findById($currencyId);
     * </code>
     *
     * @param int $id
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     *
     * @return Currency
     */
    public function fetchById($id)
    {
        if (!$id) {
            throw new \InvalidArgumentException('There is no ID.');
        }

        $data = $this->gateway->fetchById($id);

        return $this->mapper->create($data);
    }

    /**
     * Load the data from database by conditions and return an entity.
     *
     * <code>
     * $conditions = array(
     *     'code' => 'USD',
     *     'symbol' => '$'
     * );
     *
     * $gateway     = new Virtualcurrency\RealCurrency\Gateway\JoomlaGateway(\JFactory::getDbo());
     * $mapper      = new Virtualcurrency\RealCurrency\Mapper($gateway);
     * $repository  = new Virtualcurrency\RealCurrency\Repository($mapper);
     *
     * $currency    = $repository->fetch($conditions);
     * </code>
     *
     * @param array  $conditions
     *
     * @throws \UnexpectedValueException
     * @throws \RuntimeException
     *
     * @return Domain\Entity
     */
    public function fetch(array $conditions = array())
    {
        if (!$conditions) {
            throw new \UnexpectedValueException('There are no conditions that the system should use to fetch data.');
        }

        $data = $this->gateway->fetch($conditions);

        return $this->mapper->create($data);
    }

    /**
     * Load the data from database and return a collection.
     *
     * <code>
     * $conditions = array(
     *     'ids' => array(1,2,3,4)
     * );
     *
     * $gateway     = new Virtualcurrency\RealCurrency\Gateway\JoomlaGateway(\JFactory::getDbo());
     * $mapper      = new Virtualcurrency\RealCurrency\Mapper($gateway);
     * $repository  = new Virtualcurrency\RealCurrency\Repository($mapper);
     *
     * $currencies  = $repository->fetchCollection($conditions);
     * </code>
     *
     * @param array  $conditions
     *
     * @throws \UnexpectedValueException
     * @throws \RuntimeException
     *
     * @return Currencies
     */
    public function fetchCollection(array $conditions = array())
    {
        if (!$conditions) {
            throw new \UnexpectedValueException('There are no conditions that the system should use to fetch data.');
        }

        $data = $this->gateway->fetchCollection($conditions);

        if ($this->collection === null) {
            $this->collection = new Currencies;
        }

        $this->collection->clear();
        if ($data) {
            foreach ($data as $row) {
                $this->collection[] = $this->mapper->create($row);
            }
        }

        return $this->collection;
    }

    /**
     * Load the data from database and return a collection.
     *
     * <code>
     * $gateway     = new Virtualcurrency\RealCurrency\Gateway\JoomlaGateway(\JFactory::getDbo());
     * $mapper      = new Virtualcurrency\RealCurrency\Mapper($gateway);
     * $repository  = new Virtualcurrency\RealCurrency\Repository($mapper);
     *
     * $currencies  = $repository->fetchAll($conditions);
     * </code>
     *
     * @throws \UnexpectedValueException
     * @throws \RuntimeException
     *
     * @return Currencies
     */
    public function fetchAll()
    {
        $data = $this->gateway->fetchAll();

        if ($this->collection === null) {
            $this->collection = new Currencies;
        }

        $this->collection->clear();
        if ($data) {
            foreach ($data as $row) {
                $this->collection[] = $this->mapper->create($row);
            }
        }

        return $this->collection;
    }
}