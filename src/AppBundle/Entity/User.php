<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category Bundle
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Mapping\Annotation as Gedmo;
use \DateTime as DateTime;

/**
 * Entity Class User.
 *
 * @category Entity
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @ORM\Table(name="te_user", options={"comment":"User entity"})
 *
 */
class User extends BaseUser
{
    /**
     * User Id.
     *
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * User Presentation.
     *
     * TODO Markdown could be used.
     *
     * @ORM\Column(type="text", nullable=true, options={"comment":"User presentation (markdown format)"})
     *
     */
    private $presentation;

    /**
     * @ORM\Column(type="datetime", nullable=false, options={"comment":"Creation time of user"})
     * @Gedmo\Timestampable(on="create", field="created")
     */
    private $created;

    /**
     * Getter of Id property.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated():DateTime
    {
        return $this->created;
    }

    /**
     * Get presentation
     *
     * @return string
     */
    public function getPresentation():string
    {
        return $this->presentation;
    }

    /**
     * Set presentation
     *
     * @param string $presentation
     *
     * @return User
     */
    public function setPresentation(string $presentation):User
    {
        $this->presentation = $presentation;

        return $this;
    }
}
