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

use AppBundle\Entity\Famille;
use AppBundle\Entity\Repository\FamilleRepository;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class FamilleService.
 *
 * This service return some data as an html tree of the family.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class FamilleService
{
    /**
     * Entity Manager.
     *
     * @var EntityManager
     */
    protected $em;

    /**
     * Famille repository inherited from Gedmo Tree Repository.
     *
     * @var FamilleRepository
     */
    protected $repository;

    /**
     * FamilleService constructor.
     *
     * Constructor initialize entity manager and repository.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository('AppBundle:Famille');
    }

    /**
     * Retrieve a family by its ID.
     *
     * If family with specified ID does not exist, a EntityNotFoundException is thrown.
     *
     * @param int $id
     * @return Famille
     * @throws EntityNotFoundException
     */
    public function getById(int $id):Famille
    {
        $famille = $this->repository->findOneBy(['id' => $id]);
        if ($famille instanceof Famille) {
            return $famille;
        } else {
            //@TODO Translate this message.
            throw new EntityNotFoundException("Family with ID $id not found");
        }
    }

    /**
     * Retrieve html tree.
     *
     * @param array $options
     * @return array|string
     */
    public function retrieveHtmlTree(array $options):string
    {
        return $this->repository->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* true: load all children, false: only direct */
            $options
        );
    }
}
