<?php
/**
 * @package         Virtualcurrency
 * @subpackage      Cart\Helper
 * @author          Todor Iliev
 * @copyright       Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license         GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\Cart\Command;

use Virtualcurrency\Cart\Session;

/**
 * Contract between item preparers..
 *
 * @package         Virtualcurrency
 * @subpackage      Cart\Helper
 */
interface ItemPreparer
{
    public function prepare(Session $cartSession);
}
