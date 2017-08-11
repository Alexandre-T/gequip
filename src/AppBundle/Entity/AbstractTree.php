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
use DateTime;


/**
 * Abstract tree Class
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\MappedSuperclass
 * @Gedmo\Tree(type="nested")
 * @Gedmo\Loggable
 */
class AbstractTree implements InformationInterface
{
    /**
     * ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", name="id", options={"comment":"Tree ID"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Left born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="left_tree", options={"comment":"Left born of the tree"})
     * @Gedmo\TreeLeft
     */
    protected $left;

    /**
     * Right born of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="right_tree", options={"comment":"Right born of the tree"})
     * @Gedmo\TreeRight
     */
    protected $right;

    /**
     * Level of tree.
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false, name="level_tree", options={"comment":"Level on the tree"})
     * @Gedmo\TreeLevel
     */
    protected $level;

    /**
     * Name of the node.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 32)
     *
     * @ORM\Column(type="string", length=32, nullable=false, options={"comment":"Node name"})
     * @Gedmo\Versioned
     *
     */
    protected $name;

    /**
     * Name slugified.
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, options={"comment":"Name sluggified"})
     * @Gedmo\Slug(updatable=true, unique=true, fields={"name"})
     */
    protected $slug;

    /**
     * Date time of creation of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation date"})
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    /**
     * Date time of last update of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=true, options={"comment":"Last update datetime"})
     * @Gedmo\Timestampable(on="update")
     */
    protected $updated;

    /**
     * Creator of this node.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id", nullable=false)
     */
    protected $creator;

    /**
     * Last updater of this node.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="updater", referencedColumnName="id")
     */
    protected $updater;

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
     * Get name of node.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set name of this node.
     *
     * @param mixed $name
     * @return AbstractTree
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set creator.
     *
     * @param User $creator
     *
     * @return AbstractTree
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Set updater.
     *
     * @param User $updater
     *
     * @return AbstractTree
     */
    public function setUpdater(User $updater)
    {
        $this->updater = $updater;

        return $this;
    }
}
