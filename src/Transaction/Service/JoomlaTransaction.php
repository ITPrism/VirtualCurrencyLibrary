<?php
/**
 * @package      Virtualcurrency
 * @subpackage   Transactions\Service
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\Transaction\Service;

use Prism\Domain\ApplicationService;
use Virtualcurrency\Account\Account;
use Virtualcurrency\Account\Command\Gateway\JoomlaUpdateAmount;
use Virtualcurrency\Account\Command\UpdateAmount;
use Virtualcurrency\Transaction\Transaction;
use Virtualcurrency\Transaction\Mapper as TransactionMapper;
use Virtualcurrency\Transaction\Repository as TransactionRepository;
use Virtualcurrency\Transaction\Gateway\JoomlaGateway as TransactionJoomlaGateway;
use Virtualcurrency\Account\Gateway\JoomlaGateway as AccountJoomlaGateway;
use Virtualcurrency\Account\Mapper as AccountMapper;
use Virtualcurrency\Account\Repository as AccountRepository;
use Virtualcurrency\User\Commodity\Command\StoreNumber;
use Virtualcurrency\User\Commodity\Command\Gateway\JoomlaStoreNumber;
use Virtualcurrency\User\Commodity\Mapper as UserCommodityMapper;
use Virtualcurrency\User\Commodity\Repository as UserCommodityRepository;
use Virtualcurrency\User\Commodity\Gateway\JoomlaGateway as UserCommodityJoomlaGateway;

class JoomlaTransaction implements ApplicationService
{
    protected $transaction;
    protected $account;
    protected $db;

    public function __construct(Transaction $transaction, Account $account, \JDatabaseDriver $db)
    {
        $this->account     = $account;
        $this->transaction = $transaction;
        $this->db          = $db;
    }

    public function execute(array $request = array())
    {
        // Store the new transaction data.
        $txnMapper      = new TransactionMapper(new TransactionJoomlaGateway($this->db));
        $txnRepository  = new TransactionRepository($txnMapper);
        $txnRepository->store($this->transaction);

        // Decrease the amount in user's account.
        $this->account->decreaseAmount($this->transaction->getAmount());

        $updateAmountCommand  = new UpdateAmount($this->account);
        $updateAmountCommand->setGateway(new JoomlaUpdateAmount($this->db));
        $updateAmountCommand->handle();

        // Increase units.
        if (strcmp('currency', $this->transaction->getItemType()) === 0) {
            $conditions = [
                'user_id' => $request['user_id'],
                'currency_id' => $request['item_id'],
            ];

            $accountMapper      = new AccountMapper(new AccountJoomlaGateway($this->db));
            $accountRepository  = new AccountRepository($accountMapper);
            $account = $accountRepository->fetch($conditions);

            // Update account amount.
            $account->increaseAmount($this->transaction->getUnits());

            $updateAmountCommand  = new UpdateAmount($account);
            $updateAmountCommand->setGateway(new JoomlaUpdateAmount($this->db));
            $updateAmountCommand->handle();
        } else {
            $conditions = [
                'user_id' => $request['user_id'],
                'commodity_id' => $request['item_id'],
            ];

            $commodityMapper      = new UserCommodityMapper(new UserCommodityJoomlaGateway($this->db));
            $commodityRepository  = new UserCommodityRepository($commodityMapper);
            $commodity            = $commodityRepository->fetch($conditions);

            // Update the number of user commodities.
            $commodity->increaseNumber($this->transaction->getUnits());

            $updateCommodityNumber  = new StoreNumber($commodity);
            $updateCommodityNumber->setGateway(new JoomlaStoreNumber($this->db));
            $updateCommodityNumber->handle();
        }
    }
}
