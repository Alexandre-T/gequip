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
use \DateTime;

/**
 * Criticity Class
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CriticityRepository")
 * @ORM\Table(name="te_criticity", options={"comment":"Cricity of equipment"})
 * @Gedmo\Loggable
 */
class Criticity implements InformationInterface
{
    /**
     * ID of the criticity.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment":"Identifiant of criticity"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Name of the family.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=16)
     *
     * @ORM\Column(type="string", length=16, nullable=false, options={"unsigned":true,"comment":"Name of the criticity"})
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * Intervention period.
     *
     * @var string (Period string)
     *
     * @Assert\Length(max=8)
     *
     * @ORM\Column(type="string", length=8, nullable=false, options={"comment":"Intervention period"})
     * @Gedmo\Versioned
     */
    private $intervention;

    /**
     * Recovery period.
     *
     * @var string (Period string)
     *
     * @Assert\Length(max=8)
     *
     * @ORM\Column(type="string", length=8, nullable=false, options={"comment":"Recovery period"})
     * @Gedmo\Versioned
     */
    private $recovery;

    /**
     * Date time of creation of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation datetime"})
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * Date time of last update of this object.
     *
     * @var Datetime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Update datetime"})
     * @Gedmo\Timestampable(on="update")
     */
    private $updated;

    /**
     * Recovery period.
     *
     * @var string (Period string)
     *
     * @Assert\Length(max=8)
     *
     * @ORM\Column(type="string", length=8, nullable=true, options={"comment":"Average working time target (cible MTBF)"})
     * @Gedmo\Versioned
     */
    private $working;

    /**
     * Creator of this family.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id", nullable=false)
     */
    private $creator;

    /**
     * Last updater of this family.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="updater", referencedColumnName="id", nullable=false)
     */
    private $updater;

    /**
     * Get ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get Name of the Criticity
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get intervention wanting time.
     *
     * @return string
     */
    public function getIntervention()
    {
        return $this->intervention;
    }

    /**
     * Get recovery wanting time.
     *
     * @return string
     */
    public function getRecovery()
    {
        return $this->recovery;
    }

    /**
     * Get creation datetime of this entity.
     *
     * @return DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get last update datetime of this entity.
     *
     * @return DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Get the working time wanted.
     *
     * @return string
     */
    public function getWorking()
    {
        return $this->working;
    }

    /**
     * Get the creator of this entity.
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Get the updater of this entity.
     *
     * @return User
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Set creator.
     *
     * @param User $creator
     * @return Criticity
     */
    public function setCreator(User $creator): Criticity
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Setter of the name.
     *
     * @param string $name
     * @return Criticity
     */
    public function setName(string $name): Criticity
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Setter of the intervention property.
     *
     * @param string $intervention
     * @return Criticity
     */
    public function setIntervention(string $intervention): Criticity
    {
        $this->intervention = $intervention;
        return $this;
    }

    /**
     * Set updater.
     *
     * @param User $updater
     * @return Criticity
     */
    public function setUpdater(User $updater): Criticity
    {
        $this->updater = $updater;
        return $this;
    }

    /**
     * Setter of the recovery property.
     *
     * @param mixed $recovery
     * @return Criticity
     */
    public function setRecovery($recovery)
    {
        $this->recovery = $recovery;
        return $this;
    }

    /**
     * Setter of the working property.
     *
     * @param string $working
     * @return Criticity
     */
    public function setWorking(string $working): Criticity
    {
        $this->working = $working;
        return $this;
    }
}
