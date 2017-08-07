<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category Controller
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\Bean\Factory;

use AppBundle\Bean\Information;
use AppBundle\Entity\Family;

/**
 * Information bean to give some information about the last update and the creation.
 *
 * @category Factory
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 */
class InformationFactory
{
    /**
     * Create Information from a Family Entity.
     *
     * @param Family $family
     * @return Information
     */
    public static function createInformation(Family $family):Information
    {
        $information = new Information();

        $information->setCreator($family->getCreator()->getUsername());
        $information->setCreated($family->getCreated());

        //$information->setUpdater($family->getUpdater()->getUsername());
        //$information->setUpdated($family->getUpdated());

        return $information;
    }
}