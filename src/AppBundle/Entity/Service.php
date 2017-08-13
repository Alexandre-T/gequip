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

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Service Class.
 *
 * Service of the enterprise
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ServiceRepository")
 * @ORM\Table(name="te_service", options={"comment":"Service of the enterprise"})
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 */
class Service extends AbstractTree implements InformationInterface
{
    /**
     * Children of this service.
     *
     * @var Service[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Service", mappedBy="parent")
     */
    private $children;

    /**
     * Parent of this service.
     *
     * @var Service
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeParent
     *
     * @Gedmo\Versioned
     */
    private $parent;

    /**
     * Root of this service.
     *
     * @var Service
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Service")
     * @ORM\JoinColumn(name="root", referencedColumnName="id", onDelete="SET NULL")
     * @Gedmo\TreeRoot
     */
    private $root;

    /**
     * Get node root.
     *
     * @return AbstractTree
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Get children.
     *
     * @return array
     */
    public function getChildren()
    {
        return $this->children;
    }


    /**
     * Get node parent of this node.
     *
     * @return AbstractTree
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent of this service.
     *
     * @param mixed $parent
     * @return Service
     */
    public function setParent($parent):Service
    {
        $this->parent = $parent;

        return $this;
    }
}
