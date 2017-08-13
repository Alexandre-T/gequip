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

namespace AppBundle\Controller;

use AppBundle\Bean\Factory\InformationFactory;
use AppBundle\Entity\Criticity;
use AppBundle\Form\Type\CriticityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Criticity controller.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @Route("settings/criticity")
 */
class CriticityController extends Controller
{
    /**
     * Limit of criticity per page for listing.
     */
    const LIMIT_PER_PAGE = 25;
    /**
     * Lists all criticity entities.
     *
     * @Route("/", name="settings_criticity_index")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        //Retrieving all services
        $criticityService = $this->get('app.criticity-service');
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
             $criticityService->getQueryBuilder(), /* queryBuilder NOT result */
             $request->query->getInt('page', 1)/*page number*/,
             self::LIMIT_PER_PAGE,
             ['defaultSortFieldName' => 'criticity.name', 'defaultSortDirection' => 'asc']
        );

        return $this->render('@App/settings/criticity/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Creates a new criticity entity.
     *
     * @Route("/new", name="settings_criticity_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return RedirectResponse |Response
     */
    public function newAction(Request $request)
    {
        $criticity = new Criticity();
        $form = $this->createForm(CriticityType::class, $criticity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $criticityService = $this->get('app.criticity-service');
            $criticityService->create($criticity, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.criticity.created _name_', ['name' => $criticity->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_criticity_show', array('id' => $criticity->getId()));

        }

        return $this->render('@App/settings/criticity/new.html.twig', [
            'criticity' => $criticity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a criticity entity.
     *
     * @Route("/{id}", name="settings_criticity_show")
     * @Method("GET")
     *
     * @param Criticity $criticity
     * @return Response
     */
    public function showAction(Criticity $criticity)
    {
        $criticityService = $this->get('app.criticity-service');
        $deleteForm = $this->createDeleteForm($criticity);
        $information = InformationFactory::createInformation($criticity);
        $logs = $criticityService->retrieveLogs($criticity);

        return $this->render('@App/settings/criticity/show.html.twig', [
            'isDeletable' => true,
            'logs' => $logs,
            'information' => $information,
            'criticity' => $criticity,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing criticity entity.
     *
     * @Route("/{id}/edit", name="settings_criticity_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request The request
     * @param Criticity $criticity The criticity entity
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Criticity $criticity)
    {
        $criticityService = $this->get('app.criticity-service');
        $deleteForm = $this->createDeleteForm($criticity);
        $editForm = $this->createForm(CriticityType::class, $criticity);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $criticityService->update($criticity, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.criticity.updated _name_', ['name' => $criticity->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_criticity_show', array('id' => $criticity->getId()));
            }

        $logs = $criticityService->retrieveLogs($criticity);
        $information = InformationFactory::createInformation($criticity);

        return $this->render('@App/settings/criticity/edit.html.twig', [
            'isDeletable' => $criticityService->isDeletable($criticity),
            'logs' => $logs,
            'information' => $information,
            'criticity' => $criticity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a criticity entity.
     *
     * @Route("/{id}", name="settings_criticity_delete")
     * @Method("DELETE")
     *
     * @param Request $request The request
     * @param Criticity $criticity The $criticity entity
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Criticity $criticity)
    {
        $form = $this->createDeleteForm($criticity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($criticity);
            $em->flush();

            //Flash message.
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.criticity.deleted _name_', ['name' => $criticity->getName()]);
            $session->getFlashBag()->add('success', $message);
        }

        return $this->redirectToRoute('settings_criticity_index');
    }

    /**
     * Creates a form to delete a criticity entity.
     *
     * @param Criticity $criticity The criticity entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Criticity $criticity)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_criticity_delete', array('id' => $criticity->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
