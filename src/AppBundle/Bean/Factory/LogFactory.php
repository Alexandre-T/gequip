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

use AppBundle\Bean\Log;
use Gedmo\Loggable\Entity\MappedSuperclass\AbstractLogEntry;

/**
 * Log bean to give some information about the last updates and the creation.
 *
 * @category Factory
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 */
class LogFactory
{
    /**
     * Create Log bean from a Abstract Log Entry (Gedmo).
     *
     * @param array $logEntries of AbstractLogEntry $logEntry
     * @param array $families Array of Family Entity
     * @return array
     */
    public static function createFamilyLogs(array $logEntries, array $families = null):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
            /** @var AbstractLogEntry $logEntry */
            $logBean = new Log();
            $logBean->setAction('settings.log.action.'.$logEntry->getAction());
            $logBean->setLogged($logEntry->getLoggedAt());
            $logBean->setUsername($logEntry->getUsername());
            $logBean->setVersion($logEntry->getVersion());
            $logBean->setData(DataFactory::createFamilyData($logEntry->getData(), $families));
            $logs[] = $logBean;
        }


        return $logs;
    }
}
