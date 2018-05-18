<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\CarServiceType;
use App\Entity\Service;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class VisitController extends Controller
{
    /**
     * @Route("/admin/visits", name="admin_visits")
     */
    public function visitListAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $dql = "SELECT a FROM App\Entity\Visit a";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('admin/visitlist.html.twig', [
            'pagination' => $pagination,
        ]);


    }
    /**
     *
     * @Route("/admin/visits/{id}", name="admin_visits_serviced")
     * @Method("GET")
     */
    public function statusServicedAction(Car $car, \Swift_Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository(User::class)->find($id);
        $car->setServiced();
        $em->persist($car);
        $em->flush();
        $user = $car -> getUser();
        $userEmail = $user -> getEmail();
        $message = (new \Swift_Message('UAB FIX A CAR'))
            ->setFrom('thelincius@gmail.com')
            ->setTo($userEmail)
            ->setBody('Your car has been serviced! We are waiting for you at our adress: Studentu g. 50');
        $mailer->send($message);
        $this->addFlash(
            'notice',
            'Email has been sent!'
        );
        return $this->redirectToRoute('admin_visits');
    }

    /**
     *
     * @Route("/admin/visits/select/{id}", name="admin_visits_services")
     * @Method({"GET", "POST"})
     */
    public function addServicesToVisit(Car $car, Request $request)
    {
        // 1) build the form
        $form = $this->createForm(CarServiceType::class);
        // 2) handle the submit (will only happen on POST) + captcha check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $services = $form -> getData();
            foreach($services as $service){
                foreach($service as $key)
                $car -> addService($key);
            }


            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Service created successfully'
            );
            return $this->redirectToRoute('admin_visits');
        }


        return $this->render(
            'admin/Services_Select.html.twig',
            array('form' => $form->createView())
        );
    }
}