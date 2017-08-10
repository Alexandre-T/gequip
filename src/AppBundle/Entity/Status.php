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


/**
 * Status entity.
 *
 * The status entity store information about the managment, calendar.
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\StatusRepository")
 * @ORM\Table(name="te_status")
 * @Gedmo\Loggable
 */
class Status implements InformationInterface
{
    /**
     * Status ID.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"comment":"Status id"})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Creation date.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation date"})
     * @Gedmo\Timestampable(on="create")
     *
     */
    private $created;

    /**
     * Last update datetime.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, options={"comment":"Last update datetime"})
     * @Gedmo\Timestampable(on="update")
     *
     */
    private $updated;

    /**
     * Status name.
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 16)
     *
     * @ORM\Column(type="string", unique=true, length=16, nullable=false, options={"comment":"Status name"})
     * @Gedmo\Versioned
     */
    private $name;

    /**
     * Boolean answering this question: Is this status the only one initial status?
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":false,"comment":"Is it the initial status"})
     * @Gedmo\Versioned
     */
    private $initial = false;

    /**
     * Boolean answering this question: Are equipment of this status discarded?
     *
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false, options={"default":false,"comment":"Is it a discarded status"})
     * @Gedmo\Versioned
     */
    private $discarded = false;

    /**
     * Boolean answering this question: Are equipment of this status subject to calendar management?
     *
     * @var bool
     *
     * @ORM\Column(
     *     type="boolean",
     *     nullable=false,
     *     options={"default":false,"comment":"is it subject to calendar management"}
     * )
     * @Gedmo\Versioned
     */
    private $managed = false;

    /**
     * Markdown presentation of status.
     *
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, options={"comment":"markdown presentation of text"})
     * @Gedmo\Versioned
     */
    private $presentation;

    /**
     * Creator of this status.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="creator", referencedColumnName="id", nullable=false)
     */
    private $creator;

    /**
     * Last updater of this status.
     *
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", fetch="EAGER")
     * @ORM\JoinColumn(name="updater", referencedColumnName="id", nullable=false)
     */
    private $updater;

    /**
     * Getter of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter of creation datetime.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Getter of update datetime.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Getter of status name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter of initial property.
     *
     * @return bool
     */
    public function getInitial()
    {
        return $this->initial;
    }

    /**
     * Getter of discarded property.
     *
     * @return bool
     */
    public function getDiscarded()
    {
        return $this->discarded;
    }

    /**
     * Getter of managed property.
     *
     * @return bool
     */
    public function getManaged()
    {
        return $this->managed;
    }

    /**
     * Getter of presentation.
     *
     * @return string
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * Getter of creator.
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Getter of updater.
     *
     * @return User
     */
    public function getUpdater()
    {
        return $this->updater;
    }

    /**
     * Setter of name.
     *
     * @param string $name
     * @return Status
     */
    public function setName($name):Status
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Setter of initial property.
     *
     * @param bool $initial
     * @return Status
     */
    public function setInitial($initial):Status
    {
        $this->initial = $initial;
        return $this;
    }

    /**
     * Set creator.
     *
     * @param User $creator
     *
     * @return Status
     */
    public function setCreator(User $creator):Status
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Setter of discarded property.
     *
     * @param bool $discarded
     * @return Status
     */
    public function setDiscarded($discarded):Status
    {
        $this->discarded = $discarded;
        return $this;
    }

    /**
     * Setter of managed property.
     *
     * @param bool $managed
     * @return Status
     */
    public function setManaged($managed):Status
    {
        $this->managed = $managed;
        return $this;
    }

    /**
     * Setter of presentation property.
     *
     * @param string $presentation
     * @return Status
     */
    public function setPresentation($presentation):Status
    {
        $this->presentation = $presentation;
        return $this;
    }

    /**
     * Set updater.
     *
     * @param User $updater
     *
     * @return Status
     */
    public function setUpdater(User $updater):Status
    {
        $this->updater = $updater;

        return $this;
    }
}
