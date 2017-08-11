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

use AppBundle\Bean\Factory\InformationFactory;
use AppBundle\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Status controller.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @Route("settings/status")
 */
class StatusController extends Controller
{
    /**
     * Limit of status per page for listing.
     */
    const LIMIT_PER_PAGE = 25;
    /**
     * Lists all status entities.
     *
     * @Route("/", name="settings_status_index")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        //Retrieving all services
        $statusService = $this->get('app.status-service');
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $statusService->getQueryBuilder(), /* queryBuilder NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            self::LIMIT_PER_PAGE,
            ['defaultSortFieldName' => 'status.name', 'defaultSortDirection' => 'asc']
        );

        //Return the view
        return $this->render('@App/settings/status/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Creates a new status entity.
     *
     * @Route("/new", name="settings_status_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return RedirectResponse |Response
     */
    public function newAction(Request $request)
    {
        $status = new Status();
        $form = $this->createForm('AppBundle\Form\Type\StatusType', $status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statusService = $this->get('app.status-service');
            $statusService->create($status, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.status.created _name_', ['name' => $status->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_status_show', array('id' => $status->getId()));
        }

        return $this->render('@App/settings/status/new.html.twig', array(
            'status' => $status,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a status entity.
     *
     * @Route("/{id}", name="settings_status_show")
     * @Method("GET")
     *
     * @param Status $status
     * @return Response
     */
    public function showAction(Status $status)
    {
        $statusService = $this->get('app.status-service');
        $deleteForm = $this->createDeleteForm($status);
        $informations = InformationFactory::createInformation($status);
        $logs = $statusService->retrieveLogs($status);

        return $this->render('@App/settings/status/show.html.twig', array(
            'isDeletable' => true,
            'logs' => $logs,
            'status' => $status,
            'informations' => $informations,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing status entity.
     *
     * @Route("/{id}/edit", name="settings_status_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request The request
     * @param Status $status The status entity
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Status $status)
    {
        $statusService = $this->get('app.status-service');
        $deleteForm = $this->createDeleteForm($status);
        $editForm = $this->createForm('AppBundle\Form\Type\StatusType', $status);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $statusService->update($status, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.status.updated _name_', ['name' => $status->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_status_show', array('id' => $status->getId()));
        }

        $logs = $statusService->retrieveLogs($status);
        $informations = InformationFactory::createInformation($status);

        return $this->render('@App/settings/status/edit.html.twig', array(
            'logs' => $logs,
            'informations' => $informations,
            'status' => $status,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a status entity.
     *
     * @Route("/{id}", name="settings_status_delete")
     * @Method("DELETE")
     *
     * @param Request $request The request
     * @param Status $status The status entity
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Status $status)
    {
        $form = $this->createDeleteForm($status);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($status);
            $em->flush();

            //Flash message.
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.status.deleted _name_', ['name' => $status->getName()]);
            $session->getFlashBag()->add('success', $message);
        }

        return $this->redirectToRoute('settings_status_index');
    }

    /**
     * Creates a form to delete a status entity.
     *
     * @param Status $status The status entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Status $status)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_status_delete', array('id' => $status->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
