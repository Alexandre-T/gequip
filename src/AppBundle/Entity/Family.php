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
use Symfony\Component\Validator\Constraints as Assert;
use \Datetime as Datetime;

/**
 * Family Class
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\FamilyRepository")
 * @ORM\Table(name="te_family", options={"comment":"Families of road equipments"})
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 */
class Family
{
    /**
     * ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment":"Family ID"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Left born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="left_tree", options={"comment":"Left born of the tree"})
     * @Gedmo\TreeLeft
     */
    private $left;

    /**
     * Right born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="right_tree", options={"comment":"Right born of the tree"})
     * @Gedmo\TreeRight
     */
    private $right;

    /**
     * Level of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="level_tree", options={"comment":"Level on the tree"})
     * @Gedmo\TreeLevel
     */
    private $level;

    /**
     * Name of the family.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 32)
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"comment":"Family name"})
     * @Gedmo\Versioned
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=false, options={"comment":"Name sluggified"})
     * @Gedmo\Slug(updatable=true, unique=true, fields={"name"})
     */
    private $slug;

    /**
     * Date time of creation of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation date"})
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * Date time of last update of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=true, options={"comment":"Last update datetime"})
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * Children of this family.
     *
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Family", mappedBy="parent")
     * @ORM\OrderBy({"left":"ASC"})
     */
    private $children;

    /**
     * Parent of this family.
     *
     * @var Family
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Family", inversedBy="children")
     * @ORM\JoinColumn(name="parent_tree", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeParent
     * @Gedmo\Versioned
     */
    private $parent;

    /**
     * Root of this family.
     *
     * @var Family
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Family")
     * @ORM\JoinColumn(name="root_tree", referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeRoot
     */
    private $root;

    /**
     * Creator of this family.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id", nullable=false)
     */
    private $creator;

    /**
     * Last updater of this family.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="updater", referencedColumnName="id")
     */
    private $updater;

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
     * Get creator.
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
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
     * @return Family
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
     * @return Family
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Get slug (urlized name).
     *
     * The name is urlized by Gedmo:Slugable service.
     *
     * @return string urlized name
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get last updater.
     *
     * @return User
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Get update date.
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set name of this family.
     *
     * @param mixed $name
     * @return Family
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
     * @return Family
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Set creator.
     *
     * @param User $creator
     *
     * @return Family
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
    
        return $this;
    }

    /**
     * Set creator.
     *
     * @param User $updater
     *
     * @return Family
     */
    public function setUpdater(User $updater)
    {
        $this->updater = $updater;

        return $this;
    }

}
