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
use AppBundle\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Service controller.
 *
 * @category Controller
 *
 * @author  Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @license GNU General Public License, version 3
 *
 * @link http://opensource.org/licenses/GPL-3.0
 *
 * @Route("settings/service")
 */
class ServiceController extends Controller
{
    /**
     * Lists all service entities.
     *
     * @Route("/", name="settings_service_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $controller = $this;
        $serviceService = $this->get('app.service-service');

        // More information on Github
        // https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/tree.md#retrieving-as-html-tree
        $options = array(
            'decorate' => true,
            'representationField' => 'slug',
            'html' => true,
            'nodeDecorator' => function ($node) use ($controller) {
                $url = $controller->generateUrl("settings_service_show", array("slug"=>$node['slug']));
                $title = htmlentities($node['name']);
                return "<a href=\"$url\" title=\"$title\">{$node['name']}</a>";
            }
        );
        $htmlTree = $serviceService->retrieveHtmlTree($options);

        //Return the view
        return $this->render('@App/settings/service/list.html.twig', [
            'service_tree' => $htmlTree,
        ]);
    }

    /**
     * Creates a new service entity.
     *
     * @Route("/new", name="settings_service_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @return RedirectResponse |Response
     */
    public function newAction(Request $request)
    {
        $service = new Service();
        $form = $this->createForm('AppBundle\Form\Type\ServiceType', $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceService = $this->get('app.service-service');
            $serviceService->create($service, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.service.created _name_', ['name' => $service->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_service_show', array('slug' => $service->getSlug()));
        }

        return $this->render('@App/settings/service/new.html.twig', array(
            'service' => $service,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a service entity.
     *
     * @Route("/show/{slug}", name="settings_service_show", methods="get")
     * @Method("GET")
     *
     * @param string $slug
     * @return Response
     */
    public function showAction(string $slug)
    {
        $serviceService = $this->get('app.service-service');
        $service = $serviceService->getBySlug($slug);
        $information = InformationFactory::createInformation($service);
        $path = $serviceService->retrievePath($service);
        $logs = $serviceService->retrieveLogs($service);
        $deleteForm = $this->createDeleteForm($service);

        //Return the view
        return $this->render('@App/settings/service/show.html.twig', [
            //@TODO use a good method insteadof true
            'isDeletable' => true,
            'logs' => $logs,
            'service' => $service,
            'information' => $information,
            'path' => $path,
            'delete_form' => $deleteForm->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing service entity.
     *
     * @Route("/{id}/edit", name="settings_service_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request The request
     * @param Service $service The service entity
     * @return RedirectResponse|Response
     */
    public function editAction(Request $request, Service $service)
    {
        $serviceService = $this->get('app.service-service');

        $deleteForm = $this->createDeleteForm($service);
        $editForm = $this->createForm('AppBundle\Form\Type\ServiceType', $service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $serviceService->update($service, $this->getUser());

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.service.updated _name_', ['name' => $service->getName()]);
            $session->getFlashBag()->add('success', $message);

            return $this->redirectToRoute('settings_service_show', array('slug' => $service->getSlug()));
        }

        $path = $serviceService->retrievePath($service);
        $logs = $serviceService->retrieveLogs($service);
        $information = InformationFactory::createInformation($service);

        return $this->render('@App/settings/service/edit.html.twig', array(
            'path' => $path,
            'logs' => $logs,
            'information' => $information,
            'service' => $service,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a service entity.
     *
     * @Route("/{id}", name="settings_service_delete")
     * @Method("DELETE")
     *
     * @param Request $request The request
     * @param Service $service The service entity
     * @return RedirectResponse
     */
    public function deleteAction(Request $request, Service $service)
    {
        $form = $this->createDeleteForm($service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();

            //Flash message
            $session = $this->get('session');
            $trans = $this->get('translator.default');
            $message = $trans->trans('settings.service.deleted _name_', ['name' => $service->getName()]);
            $session->getFlashBag()->add('success', $message);
        }

        return $this->redirectToRoute('settings_service_index');
    }

    /**
     * Creates a form to delete a service entity.
     *
     * @param Service $service The service entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Service $service)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_service_delete', array('id' => $service->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
