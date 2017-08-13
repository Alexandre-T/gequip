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
use AppBundle\Entity\Criticity;
use AppBundle\Entity\Repository\CriticityRepository;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CriticityService.
 *
 * This service return some data from the criticity.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class CriticityService extends AbstractService
{
    /**
     * Criticity repository inherited from Gedmo Tree Repository.
     *
     * @var CriticityRepository
     */
    protected $repository;

    /**
     * Criticity Service constructor.
     *
     * Constructor initialize entity manager and repository.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $this->em->getRepository('AppBundle:Criticity');
    }

    /**
     * Return the repository
     *
     * @return CriticityRepository|\Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
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
        return $this->repository->createQueryBuilder('criticity');
    }

    /**
     * Retrieve a criticity by its ID.
     *
     * If criticity with specified ID does not exist, a EntityNotFoundException is thrown.
     *
     * @param int $id
     * @return Criticity
     * @throws EntityNotFoundException
     */
    public function getById(int $id):Criticity
    {
        $criticity = $this->repository->findOneBy(['id' => $id]);
        if ($criticity instanceof Criticity) {
            return $criticity;
        } else {
            //@TODO Translate this exception message.
            throw new EntityNotFoundException("Criticity with ID $id not found");
        }
    }

    /**
     * Retrieve logs of the criticity.
     *
     * @param Criticity $criticity
     * @return array
     */
    public function retrieveLogs(Criticity $criticity):array
    {
        // first check our log entries
        $logRepository = $this->em->getRepository('\Gedmo\Loggable\Entity\LogEntry'); // we use default log entry class
        $logs = $logRepository->getLogEntries($criticity);

        return LogFactory::createCriticityLogs($logs);
    }
}
