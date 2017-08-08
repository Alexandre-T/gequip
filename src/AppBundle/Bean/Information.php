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
    private $creator = '';
    
    /**
     * @var DateTime Date and time creation of the entity
     */
    private $created;
    
    /**
     * @var string Creator of the entity
     */
    private $updater = '';
    
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
     * @return Information
     */
    public function setCreator(string $creator = null):Information
    {
        if (is_null($creator)) {
            $this->creator = '';
        } else {
            $this->creator = $creator;
        }
        
        return $this;
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
     * @return Information
     */
    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Getter of the updater.
     *
     * @return string
     */
    public function getUpdater():string
    {
        return $this->updater;
    }

    /**
     * Setter of the updater.
     *
     * @param string $updater
     * @return Information
     */
    public function setUpdater(string $updater = null):Information
    {
        if (is_null($updater)) {
            $this->updater = '';
        } else {
            $this->updater = $updater;
        }

        return $this;
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
     * @return Information
     */
    public function setUpdated(DateTime $updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Has the creater been initialized?
     *
     * @return bool
     */
    public function hasCreator(): bool
    {
        return !empty($this->creator);
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
    public function isCreated(): bool
    {
        return !empty($this->created);
    }
    
    /**
     * Has the updated been initialized?
     *
     * @return bool
     */
    public function isUpdated(): bool
    {
        return !empty($this->updated);
    }
}
