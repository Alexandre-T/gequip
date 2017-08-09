<?php
/**
 * This file is part of the G-Equip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Repository
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\Entity;

/**
 * Interface InformationInterface
 *
 * @category Entity
 *
 * @package AppBundle\Entity
 */
interface InformationInterface
{
    /**
     * Return date time creation.
     *
     * @return \DateTime | null
     */
    public function getCreated();
    /**
     * Return date time of the last update.
     *
     * @return \DateTime | null
     */
    public function getUpdated();

    /**
     * Return creator of this entity/
     *
     * @return User | null
     */
    public function getCreator();

    /**
     * Return updater of this entity.
     * @return mixed
     */
    public function getUpdater();

    /**
     * Fluent setter of creator.
     *
     * @param User $creator
     * @return InformationInterface
     */
    public function setCreator(User $creator);

    /**
     * Fluent setter of last updater.
     *
     * @param User $updater
     * @return InformationInterface
     */
    public function setUpdater(User $updater);
}
