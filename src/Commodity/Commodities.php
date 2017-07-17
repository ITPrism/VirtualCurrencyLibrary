<?php
/**
 * @package      Virtualcurrency
 * @subpackage   Commodities
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2017 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      GNU General Public License version 3 or later; see LICENSE.txt
 */

namespace Virtualcurrency\Commodity;

use Prism\Domain\CollectionToOptions;
use Prism\Domain\Collection;
use Prism\Domain\ToOptionsMethod;

/**
 * This class contains methods used for managing a set of virtual goods.
 *
 * @package      Virtualcurrency
 * @subpackage   Commodities
 */
class Commodities extends Collection implements CollectionToOptions
{
    use ToOptionsMethod;
}
