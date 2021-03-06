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

namespace AppBundle\Service;

use AppBundle\Entity\InformationInterface;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StatusService.
 *
 * This service manage some general entity.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
abstract class AbstractService
{
    /**
     * Entity Manager.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Constructor must be designed in classes.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Inherited class must return Repository
     *
     * @return mixed
     */
    abstract public function getRepository();

    /**
     * Persist a new Status.
     *
     * Set the creator and the updater before saving.
     *
     * @param InformationInterface $entity
     * @param User $user
     */
    public function create(InformationInterface $entity, User $user)
    {
        $entity->setCreator($user);
        $this->update($entity, $user);
    }

    /**
     * Is this entity deletable?
     *
     * This method has to be overrided.
     *
     * @param $entity
     * @return bool true if entity is deletable
     */
    public function isDeletable($entity):bool
    {
        return true;
    }

    /**
     * Retrieve array of entities.
     *
     * @return array The entities.
     */
    public function retrieve()
    {
        return $this->getRepository()->findAll();
    }

    /**
     * Persist an existing Status.
     *
     * Set the updater before saving.
     *
     * @param InformationInterface $entity
     * @param User $user
     */
    public function update(InformationInterface $entity, User $user)
    {
        $entity->setUpdater($user);
        $this->em->persist($entity);
        $this->em->flush();
    }
}
