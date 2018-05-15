<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    /**
     * @Route("/admin/service/new", name="admin_service_create")
     */
    public function serviceCreateAction(Request $request)
    {
        // 1) build the form
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);

        // 2) handle the submit (will only happen on POST) + captcha check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Service created successfully'
            );
            return $this->redirectToRoute('admin_service_list');
        }

        return $this->render(
            'admin/servicenew.html.twig',
            array('form' => $form->createView())
        );


    }

    /**
     * @Route("/admin/service/list", name="admin_service_list")
     */
    public function serviceListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT a FROM App\Entity\Service a";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('admin/servicelist.html.twig', [
            'pagination' => $pagination,
        ]);


    }

    /**
     *
     * @Route("/admin/service/{id}/edit", name="admin_service_edit")
     * @Method({"GET", "POST"})
     */
    public function editServiceAction(Request $request, Service $service): Response
    {

        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Service edited');

            return $this->redirectToRoute('admin_service_list', ['id' => $service->getId()]);
        }

        return $this->render('admin/serviceedit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("admin/service/{id}/delete", name="admin_service_delete")
     * @Method("POST")
     *
     */
    public function deleteServiceAction(Request $request, Service $service): Response
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('admin_service_list');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($service);
        $em->flush();

        $this->addFlash('success', 'Service deleted');

        return $this->redirectToRoute('admin_service_list');
    }
}
