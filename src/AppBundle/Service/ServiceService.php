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
use AppBundle\Entity\Service;
use AppBundle\Entity\Repository\ServiceRepository;
use AppBundle\Exception\EntityNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ServiceService.
 *
 * This is a bad name, but this is the service what help to
 * managed the Service entity.
 *
 * This service return some data as an html tree of the service.
 *
 * @category Service
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class ServiceService extends AbstractService
{
    /**
     * Service repository inherited from Gedmo Tree Repository.
     *
     * @var ServiceRepository $repository
     */
    protected $repository;

    /**
     * Service Service constructor.
     *
     * Constructor initialize entity manager and repository.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $this->em->getRepository('AppBundle:Service');
    }

    /**
     * Retrieve a service by its ID.
     *
     * If service with specified ID does not exist, a EntityNotFoundException is thrown.
     *
     * @param int $id
     * @return Service
     * @throws EntityNotFoundException
     */
    public function getById(int $id):Service
    {
        $service = $this->repository->findOneBy(['id' => $id]);
        if ($service instanceof Service) {
            return $service;
        } else {
            //@TODO Translate this exception message.
            throw new EntityNotFoundException("Service with ID $id not found");
        }
    }

    /**
     * Retrieve a service by its slug (urlized name).
     *
     * If service with specified slug does not exist, a EntityNotFoundException is thrown.
     *
     * @param string $slug
     * @return Service
     * @throws EntityNotFoundException
     */
    public function getBySlug(string $slug):Service
    {
        $service = $this->repository->findOneBy(['slug' => $slug]);
        if ($service instanceof Service) {
            return $service;
        } else {
            //@TODO Translate this exception message.
            throw new EntityNotFoundException("Service with slug $slug not found");
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

    /**
     * Retrieve path of the tree.
     *
     * @param Service $service
     * @return array
     */
    public function retrievePath(Service $service):array
    {
        return $this->repository->getPath($service);
    }

    /**
     * Retrieve logs of the tree.
     *
     * @param Service $service
     * @return array
     */
    public function retrieveLogs(Service $service):array
    {
        // first check our log entries
        $logRepository = $this->em->getRepository('\Gedmo\Loggable\Entity\LogEntry'); // we use default log entry class
        $logs = $logRepository->getLogEntries($service);
        $ids = [];
        $families = [];

        foreach ($logs as $key => $log) {
            /* @var \Gedmo\Loggable\Entity\LogEntry $log */
            $data = $log->getData();

            if (isset($data['parent']['id'])) {
                $ids[]=$data['parent']['id'];
            }
        }
        //Si on a un élément dans $ids
        if (count($ids)) {
            //On execute une SEULE requete pour récupérer tous les noms...
            $families = $this->repository->findBy(['id' => $ids]);
        }

        return LogFactory::createServicesLogs($logs, $families);
    }
}
