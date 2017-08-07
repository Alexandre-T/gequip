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

namespace AppBundle\Bean;

use \DateTime as DateTime;

/**
 * Log bean to give some information about the last updates realized.
 *
 * @category Bean
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 */
class Log
{
    /**
     * @var int Version of the entity.
     */
    private $version;

    /**
     * @var string update or create
     */
    private $action;

    /**
     * @var DateTime Date time of log
     */
    private $logged;

    /**
     * @var string username
     */
    private $username;

    /**
     * @var array data
     */
    private $data = [];

    /**
     * Getter of version.
     *
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * Setter of version.
     *
     * @param int $version
     */
    public function setVersion(int $version)
    {
        $this->version = $version;
    }

    /**
     * Getter of action.
     *
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * Setter of action.
     *
     * @param string $action
     */
    public function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * Getter of DateTime.
     *
     * @return DateTime
     */
    public function getLogged(): DateTime
    {
        return $this->logged;
    }

    /**
     * Setter of Log time.
     *
     * @param DateTime $logged
     */
    public function setLogged(DateTime $logged)
    {
        $this->logged = $logged;
    }

    /**
     * Getter of username.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Setter of username.
     *
     * @param string $username
     */
    public function setUsername(string $username = null)
    {
        if (is_null($username)){
            $this->username = '';
        }else{
            $this->username = $username;
        }
    }

    /**
     * Getter of data.
     *
     * @return mixed
     */
    public function getData():array
    {
        return $this->data;
    }

    /**
     * Setter of data.
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

}