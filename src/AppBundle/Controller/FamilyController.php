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

use AppBundle\Entity\Family;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Family controller.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @Route("settings/family")
 */
class FamilyController extends Controller
{
    /**
     * Lists all family entities.
     *
     * @Route("/", name="settings_family_index")
     * @Method("GET")
     */
    public function indexAction()
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
                $url = $controller->generateUrl("settings_family_show", array("slug"=>$node['slug']));
                $title = htmlentities($node['name']);
                return "<a href=\"$url\" title=\"$title\">{$node['name']}</a>";
            }
        );
        $htmlTree = $familyService->retrieveHtmlTree($options);

        //Return the view
        return $this->render('@App/settings/family/list.html.twig', [
            'family_tree' => $htmlTree,
        ]);
    }

    /**
     * Creates a new family entity.
     *
     * @Route("/new", name="settings_family_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return RedirectResponse |Response
     */
    public function newAction(Request $request)
    {
        $family = new Family();
        $form = $this->createForm('AppBundle\Form\FamilyType', $family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //@TODO add a flash message !

            $family->setCreator($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($family);
            $em->flush();

            return $this->redirectToRoute('settings_family_show', array('slug' => $family->getSlug()));
        }

        return $this->render('@App/settings/family/new.html.twig', array(
            'family' => $family,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a family entity.
     *
     * @Route("/show/{slug}", name="settings_family_show", methods="get")
     * @Method("GET")
     *
     * @param string $slug
     * @return Response
     */
    public function showAction(string $slug)
    {
        $familyService = $this->get('app.family-service');
        $family = $familyService->getBySlug($slug);
        $path = $familyService->retrievePath($family);
        $logs = $familyService->retrieveLogs($family);
        $deleteForm = $this->createDeleteForm($family);

        //Return the view
        return $this->render('@App/settings/family/show.html.twig', [
            //@TODO use a good method insteadof true
            'isDeletable' => true,
            'logs' => $logs,
            'family' => $family,
            'path' => $path,
            'delete_form' => $deleteForm->createView(),
        ]);

    }

    /**
     * Displays a form to edit an existing family entity.
     *
     * @Route("/{id}/edit", name="settings_family_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request The request
     * @param Family $family The family entity
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Family $family)
    {
        $deleteForm = $this->createDeleteForm($family);
        $editForm = $this->createForm('AppBundle\Form\FamilyType', $family);
        $editForm->handleRequest($request);

        //@TODO add a flash message !
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('settings_family_show', array('slug' => $family->getSlug()));
        }

        return $this->render('@App/settings/family/edit.html.twig', array(
            'family' => $family,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a family entity.
     *
     * @Route("/{id}", name="settings_family_delete")
     * @Method("DELETE")
     *
     * @param Request $request The request
     * @param Family $family The family entity
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Family $family)
    {
        $form = $this->createDeleteForm($family);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($family);
            $em->flush();
        }

        return $this->redirectToRoute('settings_family_index');
    }

    /**
     * Creates a form to delete a family entity.
     *
     * @param Family $family The family entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Family $family)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_family_delete', array('id' => $family->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
