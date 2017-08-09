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
use AppBundle\Entity\Status;
use AppBundle\Entity\Repository\StatusRepository;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StatusService.
 *
 * This service return some data from the status.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class StatusService extends AbstractService
{
    /**
     * Status repository inherited from Gedmo Tree Repository.
     *
     * @var StatusRepository
     */
    protected $repository;

    /**
     * Status Service constructor.
     *
     * Constructor initialize entity manager and repository.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository('AppBundle:Status');
    }

    /**
     * Retrieve a status by its ID.
     *
     * If status with specified ID does not exist, a EntityNotFoundException is thrown.
     *
     * @param int $id
     * @return Status
     * @throws EntityNotFoundException
     */
    public function getById(int $id):Status
    {
        $status = $this->repository->findOneBy(['id' => $id]);
        if ($status instanceof Status) {
            return $status;
        } else {
            //@TODO Translate this exception message.
            throw new EntityNotFoundException("Status with ID $id not found");
        }
    }

    /**
     * Retrieve logs of the status.
     *
     * @param Status $status
     * @return array
     */
    public function retrieveLogs(Status $status):array
    {
        // first check our log entries
        $logRepository = $this->em->getRepository('\Gedmo\Loggable\Entity\LogEntry'); // we use default log entry class
        $logs = $logRepository->getLogEntries($status);

        return LogFactory::createStatusLogs($logs);
    }
}
