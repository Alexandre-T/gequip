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
use Symfony\Component\HttpFoundation\Response;

/**
 * Setting Controller Class.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 */
class SettingsController extends Controller
{
    /**
     * Settings Index.
     *
     * @Route("/settings", name="settings")
     * @Route("/settings/", name="settings_slash")
     *
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@App/settings/index.html.twig', [
            'base_dir'   => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * List Family tree.
     *
     * @Route("/settings/families/list", name="settings_families_list")
     *
     * @return Response
     */
    public function listFamilyAction()
    {
        $controller = $this;
        $familyService = $this->get('app.family-service');

        // More information on Github
        // https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/tree.md#retrieving-as-html-tree
        $options = array(
            'decorate' => true,
            'representationField' => 'slug',
            'html' => true,
            'nodeDecorator' => function ($node) use ($controller) {
                //@TODO replace id by slug (and add Gedmo sluggable)
                $url = $controller->generateUrl("settings_families_show", array("id"=>$node['id']));
                $title = htmlentities($node['name']);
                return "<a href=\"$url\" title=\"$title\">{$node['name']}</a>";
            }
        );
        $htmlTree = $familyService->retrieveHtmlTree($options);

        //Return the view
        return $this->render('@App/settings/family/list.html.twig', [
            'family_tree' => $htmlTree,
            'base_dir'   => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * Show a Family.
     *
     * @Route("/settings/families/show/{id}", name="settings_families_show", methods="get")
     *
     * @param int $id
     * @return Response
     */
    public function showFamilyAction($id)
    {
        $familyService = $this->get('app.family-service');
        $family = $familyService->getById($id);
        $path = $familyService->retrievePath($family);

        //Return the view
        return $this->render('@App/settings/family/show.html.twig', [
            'family' => $family,
            'path' => $path,
        ]);
    }
}
