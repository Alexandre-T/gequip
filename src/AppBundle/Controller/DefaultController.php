<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category Controller
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default Controller Class.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */
class DefaultController extends Controller
{
    /**
     * Homepage.
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        //Catch the token manager
        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir'   => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'csrf_token' => $csrfToken,
        ]);
    }
}
