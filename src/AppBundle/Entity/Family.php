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
 * Family Class
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FamilyRepository")
 * @ORM\Table(name="te_family", options={"comment":"Families of road equipments"})
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 *
 */
class Family extends AbstractTree implements InformationInterface
{
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Family", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Family", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeParent
     *
     * @Gedmo\Versioned
     */
    private $parent;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Family")
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
     * Set parent of this family.
     *
     * @param mixed $parent
     * @return Family
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }
}
