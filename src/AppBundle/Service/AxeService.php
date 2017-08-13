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

use AppBundle\Bean\Factory\LogFactory;
use AppBundle\Entity\Axe;
use AppBundle\Entity\Repository\AxeRepository;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AxeService.
 *
 * This service return some data from the axe.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class AxeService extends AbstractService
{
    /**
     * Axe repository inherited from Gedmo Tree Repository.
     *
     * @var AxeRepository
     */
    protected $repository;

    /**
     * Axe Service constructor.
     *
     * Constructor initialize entity manager and repository.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $this->em->getRepository('AppBundle:Axe');
    }

    /**
     * Return the repository
     *
     * @return AxeRepository|\Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * Return the Query builder.
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->repository->createQueryBuilder('axe');
    }

    /**
     * Retrieve a axe by its ID.
     *
     * If axe with specified ID does not exist, a EntityNotFoundException is thrown.
     *
     * @param int $id
     * @return Axe
     * @throws EntityNotFoundException
     */
    public function getById(int $id):Axe
    {
        $axe = $this->repository->findOneBy(['id' => $id]);
        if ($axe instanceof Axe) {
            return $axe;
        } else {
            //@TODO Translate this exception message.
            throw new EntityNotFoundException("Axe with ID $id not found");
        }
    }

    /**
     * Retrieve logs of the axe.
     *
     * @param Axe $axe
     * @return array
     */
    public function retrieveLogs(Axe $axe):array
    {
        // first check our log entries
        $logRepository = $this->em->getRepository('\Gedmo\Loggable\Entity\LogEntry'); // we use default log entry class
        $logs = $logRepository->getLogEntries($axe);

        return LogFactory::createAxeLogs($logs);
    }
}
