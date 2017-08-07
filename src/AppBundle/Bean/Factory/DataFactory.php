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

use AppBundle\Bean\Data;
use AppBundle\Entity\Family;
use AppBundle\Exception\InvalidLogException;

/**
 * Data bean to give old value if it has been retrieved.
 *
 * @category Factory
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 */
class DataFactory
{
    /**
     * Create Data from a serialized data?
     *
     * @param array $rowdata
     * @param array $families
     * @return array of Data
     * @throws InvalidLogException
     */
    public static function createFamilyData(array $rowdata, array $families = []):array
    {
        $resultat = [];
        self::unverified($rowdata);

        if (!empty($rowdata['name']))
        {
            $data = new Data();
            $data->setName($rowdata['name']);
            $data->setLabel('settings.label.name');
            $resultat[] = $data;
        }
        if (!empty($rowdata['parent']))
        {
            //ajoute le tet si id est vide, ça ira plus vite!!!!
            $data = new Data();
            $find = false;
            foreach($families as $family)
            {
                /** @var Family $family */
                if ($rowdata['parent']['id'] == $family->getId()){
                    $data->setName($family->getName());
                    $find = true;
                    break;
                }

            }
            //No more parent
            if ($find)
            {
                $data->setId($rowdata['parent']['id']);
                $data->setNoMore(!$find);
                $data->setLabel('settings.label.parent');
            }
            $resultat[] = $data;
        }

        return $resultat;

    }

    /**
     * @param array $rowdata
     * @throws InvalidLogException
     */
    private static function unverified(array $rowdata)
    {
        if (0 == count($rowdata))
        {
            throw new InvalidLogException('Log array must have a parent or a name key. There is no key in this one.');
        }
        if (1 == count($rowdata) and (!key_exists('parent', $rowdata) and !key_exists('name', $rowdata)))
        {
            throw new InvalidLogException('Log array must have a parent or a name key. The key is not valid.');
        }
        if (2 == count($rowdata) and (!key_exists('parent', $rowdata) or !key_exists('name', $rowdata)))
        {
            throw new InvalidLogException('Log array must have a parent or a name key. One of the two keys is not valid.');
        }
    }
}