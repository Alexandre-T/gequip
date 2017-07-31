<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Testing
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Utilisateur;
use PHPUnit\Framework\TestCase;

/**
 * User Entity test case.
 *
 * @category Testing
 *
 * @author   Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license  GNU General Public License, version 3
 *
 * @link     http://opensource.org/licenses/GPL-3.0
 */
class UtilisateurTest extends TestCase
{
    /**
     * @var Utilisateur
     */
    private $utilisateur;

    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        $this->utilisateur = new Utilisateur();
    }

    /**
     * All value must be null after creation
     */
    public function testConstructor()
    {
        self::assertNull($this->utilisateur->getId());
    }
}
