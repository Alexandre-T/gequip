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
     * @param AbstractLogEntry[] $logEntries of AbstractLogEntry $logEntry
     * @return array
     */
    public static function createAxeLogs(array $logEntries):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
            $logBean = new Log();
            $logBean->setAction('settings.log.action.'.$logEntry->getAction());
            $logBean->setLogged($logEntry->getLoggedAt());
            $logBean->setUsername($logEntry->getUsername());
            $logBean->setVersion($logEntry->getVersion());
            $logBean->setData(DataFactory::createAxeData($logEntry->getData()));
            $logs[] = $logBean;
        }

        return $logs;
    }
    /**
     * Create Log bean from a Abstract Log Entry (Gedmo).
     *
     * @param AbstractLogEntry[] $logEntries of AbstractLogEntry $logEntry
     * @param array $families Array of Family Entity
     * @return array
     */
    public static function createFamilyLogs(array $logEntries, array $families = null):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
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

    /**
     * Create Log bean from a Abstract Log Entry (Gedmo).
     *
     * @param AbstractLogEntry[] $logEntries of AbstractLogEntry $logEntry
     * @param array $services Array of Service Entity
     * @return array
     */
    public static function createServicesLogs(array $logEntries, array $services = null):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
            $logBean = new Log();
            $logBean->setAction('settings.log.action.'.$logEntry->getAction());
            $logBean->setLogged($logEntry->getLoggedAt());
            $logBean->setUsername($logEntry->getUsername());
            $logBean->setVersion($logEntry->getVersion());
            $logBean->setData(DataFactory::createServiceData($logEntry->getData(), $services));
            $logs[] = $logBean;
        }

        return $logs;
    }

    /**
     * Create Log bean from a Abstract Log Entry (Gedmo).
     *
     * @param AbstractLogEntry[] $logEntries of AbstractLogEntry $logEntry
     * @return array
     */
    public static function createStatusLogs(array $logEntries):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
            $logBean = new Log();
            $logBean->setAction('settings.log.action.'.$logEntry->getAction());
            $logBean->setLogged($logEntry->getLoggedAt());
            $logBean->setUsername($logEntry->getUsername());
            $logBean->setVersion($logEntry->getVersion());
            $logBean->setData(DataFactory::createStatusData($logEntry->getData()));
            $logs[] = $logBean;
        }

        return $logs;
    }

    /**
     * Create Log bean from a Abstract Log Entry (Gedmo) to provide CriticityLog.
     *
     * @param AbstractLogEntry[] $logEntries of AbstractLogEntry $logEntry
     * @return array
     */
    public static function createCriticityLogs(array $logEntries):array
    {
        $logs = [];

        foreach ($logEntries as $logEntry) {
            $logBean = new Log();
            $logBean->setAction('settings.log.action.'.$logEntry->getAction());
            $logBean->setLogged($logEntry->getLoggedAt());
            $logBean->setUsername($logEntry->getUsername());
            $logBean->setVersion($logEntry->getVersion());
            $logBean->setData(DataFactory::createCriticityData($logEntry->getData()));
            $logs[] = $logBean;
        }

        return $logs;
    }
}
