<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CarController extends Controller
{

    /**
     * @Route("/cars/list", name="car_list")
     */
    public function carListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$users = $entityManager->getRepository(User::class)->findAll();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $cars = $user->getCars();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $cars, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('web/cars.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    /**
     * @Route("/cars/new", name="car_new")
     */
    public function serviceCreateAction(Request $request)
    {
        // 1) build the form
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        // 2) handle the submit (will only happen on POST) + captcha check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $car->setServiced(0);
            // 4) save the User!
            $user = $this->get('security.token_storage')->getToken()->getUser();
            $user->addCar($car);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($car);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Car created successfully'
            );
            return $this->redirectToRoute('car_list');
        }

        return $this->render(
            'web/cars_new.html.twig',
            array('form' => $form->createView())
        );


    }
}
