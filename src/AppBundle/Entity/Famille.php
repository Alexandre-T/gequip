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
use \Datetime as Datetime;

/**
 * Famille Class
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FamilleRepository")
 * @ORM\Table(name="te_famille", options={"comment":"Famille d'équipements routiers"})
 * @Gedmo\Tree(type="nested")
 */
class Famille
{
    /**
     * ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment":"Identifiant de la famille"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Left born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="left_tree", options={"comment":"Borne gauche de l'arbre"})
     * @Gedmo\TreeLeft
     */
    private $left;

    /**
     * Right born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="right_tree", options={"comment":"Borne droite de l'arbre"})
     * @Gedmo\TreeRight
     */
    private $right;

    /**
     * Level of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="level_tree", options={"comment":"Niveau de l'arbre"})
     * @Gedmo\TreeLevel
     */
    private $level;

    /**
     * Name of the family.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"comment":"Nom de la famille"})
     */
    private $name;

    /**
     * Date time of creation of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Date de création automatique"})
     * @Gedmo\Timestampable(on="create", field="created")
     */
    private $created;

    /**
     * Children of this family.
     *
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Famille", mappedBy="parent")
     * @ORM\OrderBy({"left":"ASC"})
     */
    private $children;

    /**
     * Parent of this family.
     *
     * @var Famille
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Famille", inversedBy="children")
     * @ORM\JoinColumn(name="parent_tree", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeParent
     */
    private $parent;

    /**
     * Root of this family.
     *
     * @var Famille
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Famille")
     * @ORM\JoinColumn(name="root_tree", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeRoot
     */
    private $root;

    /**
     * Get ID.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Get creation date.
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get Left Borne of nested tree.
     *
     * @return integer
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Get Level of nested tree.
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get name of family.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get family parent of this family.
     *
     * @return Famille
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get right born of nested tree.
     *
     * @return integer
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * Get family root.
     *
     * @return Famille
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set name of this family.
     *
     * @param mixed $name
     * @return Famille
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set parent of this family.
     *
     * @param mixed $parent
     * @return Famille
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
