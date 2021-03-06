<?php
/**
 * This file is part of the GEquip Application.
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

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Status;
use Doctrine\ORM\EntityRepository;

/**
 * Class Status Repository.
 *
 * @category Repository
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class StatusRepository extends EntityRepository
{
    /**
     * Finds all status in the repository order by name.
     *
     * @return Status[] The status.
     */
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
