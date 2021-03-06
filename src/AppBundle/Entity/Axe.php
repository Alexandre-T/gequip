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

use CrEOF\Spatial\DBAL\Types\GeometryType;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use \DateTime;

/**
 * Axe Entity
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AxeRepository")
 * @ORM\Table(name="te_axe", options={"comment":"Axe of equipment"})
 * @Gedmo\Loggable
 * @UniqueEntity("code")
 * @UniqueEntity("name")
 */
class Axe implements InformationInterface
{
    /**
     * ID of the axe.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment":"Identifiant of axe"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Name of the axe.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=16)
     *
     * @ORM\Column(type="string", unique=true, length=16, nullable=false, options={"comment":"Name of the axe"})
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * Code of the axe.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=8)
     *
     * @ORM\Column(type="string", unique=true, length=8, nullable=false, options={"comment":"Code of the axe "})
     * @Gedmo\Versioned
     */
    private $code;

    /**
     * Datetime creation of the axe.
     *
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation datetime"})
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * Last update datetime of the axe.
     *
     * @var DateTime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Update datetime"})
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * Geometry point.
     *
     * @var GeometryType
     *
     * @ORM\Column(type="geometry",nullable=true)
     */
    private $geometry;

    /**
     * Creator of this axe.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id", nullable=false)
     */
    private $creator;

    /**
     * Last updater of this axe.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="updater", referencedColumnName="id", nullable=false)
     */
    private $updater;

    /**
     * Return the identifiant of this axe.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return the name of this axe.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the code of this axe.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Return the datetime creation of this axe.
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Return the last update datetime of this axe.
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Return the creator of the Axe.
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Return the geometry.
     *
     * @return GeometryType
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * Return the last updater of the Axe.
     *
     * @return User
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Setter of the axe's name.
     *
     * @param string $name
     * @return Axe
     */
    public function setName(string $name): Axe
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Setter of the axe's code.
     *
     * @param string $code
     * @return Axe
     */
    public function setCode(string $code): Axe
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Setter of the axe's creator.
     *
     * @param User $creator
     * @return Axe
     */
    public function setCreator(User $creator): Axe
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Setter of the geometry of this axe.
     *
     * @param GeometryType $geometry
     * @return Axe
     */
    public function setGeometry(GeometryType $geometry): Axe
    {
        $this->geometry = $geometry;
        return $this;
    }

    /**
     * Setter of the axe's updater.
     *
     * @param User $updater
     * @return Axe
     */
    public function setUpdater(User $updater): Axe
    {
        $this->updater = $updater;
        return $this;
    }
}
