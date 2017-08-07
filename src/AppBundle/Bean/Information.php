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
 * Information bean to give some information about the last update and the creation.
 *
 * @category Bean
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 */
class Information
{
    /**
     * @var string Creator of the entity
     */
    private $creator;
    
    /**
     * @var DateTime Date and time creation of the entity
     */
    private $created;
    
    /**
     * @var string Creator of the entity
     */
    private $updater;
    
    /**
     * @var DateTime Date and time creation of the entity
     */
    private $updated;

    /**
     * Getter of the creator.
     *
     * @return string | null
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Setter of the creator.
     *
     * @param string $creator
     */
    public function setCreator(string $creator)
    {
        $this->creator = $creator;
    }

    /**
     * Getter of the creation date time.
     *
     * @return DateTime | null
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Setter of the creation date time.
     *
     * @param DateTime $created
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;
    }

    /**
     * Getter of the updater.
     *
     * @return string | null
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Setter of the updater.
     * 
     * @param string $updater
     */
    public function setUpdater(string $updater)
    {
        $this->updater = $updater;
    }

    /**
     * Getter of update time.
     * 
     * @return DateTime | null
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Setter of update time.
     * 
     * @param DateTime $updated
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * Has the creater been initialized?
     *
     * @return bool
     */
    public function hasCreater(): bool
    {
        return !empty($this->creater);
    }
    
    /**
     * Has the updater been initialized?
     *
     * @return bool
     */
    public function hasUpdater(): bool
    {
        return !empty($this->updater);
    }

    /**
     * Has the created been initialized?
     *
     * @return bool
     */
    public function hasCreated(): bool
    {
        return !empty($this->created);
    }
    
    /**
     * Has the updated been initialized?
     *
     * @return bool
     */
    public function hasUpdated(): bool
    {
        return !empty($this->updated);
    }
}