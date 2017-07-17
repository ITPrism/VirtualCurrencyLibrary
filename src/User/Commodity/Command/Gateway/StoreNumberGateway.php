<?php
/**
 * @package      Virtualcurrency\User\Commodities
 * @subpackage   Commands\Gateways
 * @author          Todor Iliev
 * @copyright       Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license         GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\User\Commodity\Command\Gateway;

use Virtualcurrency\User\Commodity\Commodity;

/**
 * Contract between database drivers and gateway objects.
 *
 * @package      Virtualcurrency\User\Commodities
 * @subpackage   Commands\Gateways
 */
interface StoreNumberGateway
{
    /**
     * Update the number of commodities in stock.
     *
     * @param Commodity $commodity
     */
    public function store(Commodity $commodity);
}
