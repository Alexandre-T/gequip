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
     * Valid columns of family entity.
     */
    const VALID_FAMILY = ['name', 'parent'];

    /**
     * Valid columns of status.
     */
    const VALID_STATUS = ['name', 'presentation', 'initial', 'discarded', 'managed'];

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
        self::unverifiedFamily($rowdata);

        if (!empty($rowdata['name'])) {
            $data = new Data();
            $data->setName($rowdata['name']);
            $data->setLabel('settings.label.name');
            $resultat[] = $data;
        }
        if (!empty($rowdata['parent'])) {
            $data = new Data();
            if (is_null($rowdata['parent']['id'])) {
                $data->setNone(true);
                $data->setLabel('settings.label.parent');
            } else {
                $find = false;
                foreach ($families as $family) {
                    /** @var Family $family */
                    if ($rowdata['parent']['id'] == $family->getId()) {
                        $data->setName($family->getName());
                        $data->setLabel('settings.label.parent');
                        $find = true;
                        break;
                    }
                }
                //No more parent
                if (!$find) {
                    $data->setId($rowdata['parent']['id']);
                    $data->setNoMore(!$find);
                    $data->setLabel('settings.label.parent');
                    $data->setEntity('Family');
                }
            }
            $resultat[] = $data;
        }

        return $resultat;
    }

    /**
     * Create Data from a serialized data.
     *
     * @param array $rowdata
     * @return array of Data
     * @throws InvalidLogException
     */
    public static function createStatusData(array $rowdata):array
    {
        self::unverifiedStatus($rowdata);

        //Initialization
        $resultat = [];

        foreach ($rowdata as $column => $value) {
            $data = new Data();
            $data->setLabel("settings.status.field.$column");
            if (in_array($column, ['initial', 'managed', 'discarded'])) {
                $data->setName($value?'yes':'no');
                $data->setTranslate(true);
            } elseif (empty($value)) {
                $data->setNone(true);
            } else {
                $data->setName($value);
            }
            $resultat[] = $data;
        }

        return $resultat;
    }

    /**
     * This function throw an Invalid Log Exception when parameter does not contain valid keys.
     *
     * Valid keys are only : 'parent' and/or 'name'
     * Array must contain one or two of these keys
     *
     * @param array $rowdata
     * @throws InvalidLogException
     */
    private static function unverifiedFamily(array $rowdata)
    {
        if (!static::unverifiedLog($rowdata, self::VALID_FAMILY)) {
            $validKeyString = implode(', ', self::VALID_FAMILY);
            //@TODO Translate this message
            throw new InvalidLogException("Family log array must have at least one of theses keys: $validKeyString. All other keys are forbidden.");
        }
    }

    /**
     * This function throw an Invalid Log Exception when parameter does not contain valid keys.
     *
     * Valid keys are only : 'presentation', 'name', '', '', '', ''
     * Array must contain one or two of these keys
     *
     * @param array $rowdata
     * @throws InvalidLogException
     */
    private static function unverifiedStatus(array $rowdata)
    {
        if (!static::unverifiedLog($rowdata, self::VALID_STATUS)) {
            $validKeyString = implode(', ', self::VALID_STATUS);
            //@TODO Translate this message
            throw new InvalidLogException("Status log array must have at least one of these keys: $validKeyString. All other keys are forbidden.");
        }
    }

    /**
     * Verify that all keys in $rowdata are valid keys.
     *
     * @param array $rowdata array to verify
     * @param array $validKeys array of authorized keys
     * @return bool
     */
    private static function unverifiedLog(array $rowdata, array $validKeys)
    {
        if (0 === count($rowdata)) {
            return false;
        }

        foreach ($rowdata as $key => $data) {
            if (!in_array($key, $validKeys)) {
                return false;
            }
        }

        return true;
    }
}
