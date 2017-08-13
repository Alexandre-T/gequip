<?php
/**
 * This file is part of the GEquipe Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category Entity
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Axe;
use Doctrine\ORM\EntityRepository;

/**
 * Class Axe Repository.
 *
 * @category Repository
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class AxeRepository extends EntityRepository
{
    /**
     * Finds all axe in the repository order by name.
     *
     * @return Axe[] The axe.
     */
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
