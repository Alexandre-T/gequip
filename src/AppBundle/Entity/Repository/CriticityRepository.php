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

use AppBundle\Entity\Criticity;
use Doctrine\ORM\EntityRepository;

/**
 * Class Criticity Repository.
 *
 * @category Repository
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class CriticityRepository extends EntityRepository
{
    /**
     * Finds all criticity in the repository order by name.
     *
     * @return Criticity[] The criticity.
     */
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}
