<?php
/**
 * @package         Virtualcurrency\Commodity
 * @subpackage      Command\Gateway
 * @author          Todor Iliev
 * @copyright       Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license         GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\Commodity\Command\Gateway;

/**
 * Contract between database drivers and gateway objects.
 *
 * @package      Virtualcurrency\Commodity
 * @subpackage   Command\Gateway
 */
interface CreateCommoditiesGateway
{
    /**
     * Create an account.
     *
     * @param int $userId
     */
    public function create($userId);
}
