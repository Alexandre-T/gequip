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

/**
 * Entity Class Utilisateur.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UtilisateurRepository")
 */
class Utilisateur extends BaseUser
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
     * @ORM\Column(type="text", nullable=true, options={"comment":"Description Markdown de l'utilisateur"})
     */
    private $presentation;

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
     * Set presentation
     *
     * @param string $presentation
     *
     * @return Utilisateur
     */
    public function setPresentation(string $presentation)
    {
        $this->presentation = $presentation;
    
        return $this;
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
}
