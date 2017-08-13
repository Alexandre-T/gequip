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
use AppBundle\Entity\Axe;
use AppBundle\Form\Type\AxeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Axe controller.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @Route("settings/axe")
 */
class AxeController extends Controller
{
    /**
     * Limit of axe per page for listing.
     */
    const LIMIT_PER_PAGE = 25;
    /**
     * Lists all axe entities.
     *
     * @Route("/", name="settings_axe_index")
     * @Method("GET")
     *
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        //Retrieving all services
        $axeService = $this->get('app.axe-service');
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
             $axeService->getQueryBuilder(), /* queryBuilder NOT result */
             $request->query->getInt('page', 1)/*page number*/,
             self::LIMIT_PER_PAGE,
             ['defaultSortFieldName' => 'axe.code', 'defaultSortDirection' => 'asc']
        );

        return $this->render('@App/settings/axe/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Creates a new axe entity.
     *
     * @Route("/new", name="settings_axe_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return RedirectResponse |Response
     */
    public function newAction(Request $request)
    {
        $axe = new Axe();
        $form = $this->createForm(AxeType::class, $axe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $axeService = $this->get('app.axe-service');
            $axeService->create($axe, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.axe.created _name_', ['name' => $axe->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_axe_show', array('id' => $axe->getId()));

        }

        return $this->render('@App/settings/axe/new.html.twig', [
            'axe' => $axe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Finds and displays a axe entity.
     *
     * @Route("/{id}", name="settings_axe_show")
     * @Method("GET")
     *
     * @param Axe $axe
     * @return Response
     */
    public function showAction(Axe $axe)
    {
        $axeService = $this->get('app.axe-service');
        $deleteForm = $this->createDeleteForm($axe);
        $information = InformationFactory::createInformation($axe);
        $logs = $axeService->retrieveLogs($axe);

        return $this->render('@App/settings/axe/show.html.twig', [
            'isDeletable' => true,
            'logs' => $logs,
            'information' => $information,
            'axe' => $axe,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing axe entity.
     *
     * @Route("/{id}/edit", name="settings_axe_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request The request
     * @param Axe $axe The axe entity
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Axe $axe)
    {
        $axeService = $this->get('app.axe-service');
        $deleteForm = $this->createDeleteForm($axe);
        $editForm = $this->createForm(AxeType::class, $axe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $axeService->update($axe, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.axe.updated _name_', ['name' => $axe->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_axe_show', array('id' => $axe->getId()));
            }

        $logs = $axeService->retrieveLogs($axe);
        $information = InformationFactory::createInformation($axe);

        return $this->render('@App/settings/axe/edit.html.twig', [
            'isDeletable' => $axeService->isDeletable($axe),
            'logs' => $logs,
            'information' => $information,
            'axe' => $axe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Deletes a axe entity.
     *
     * @Route("/{id}", name="settings_axe_delete")
     * @Method("DELETE")
     *
     * @param Request $request The request
     * @param Axe $axe The $axe entity
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Axe $axe)
    {
        $form = $this->createDeleteForm($axe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($axe);
            $em->flush();

            //Flash message.
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.axe.deleted _name_', ['name' => $axe->getName()]);
            $session->getFlashBag()->add('success', $message);
        }

        return $this->redirectToRoute('settings_axe_index');
    }

    /**
     * Creates a form to delete a axe entity.
     *
     * @param Axe $axe The axe entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Axe $axe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_axe_delete', array('id' => $axe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
