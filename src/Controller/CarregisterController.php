<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CarregisterController extends Controller
{
    /**
     * @Route("/carregister", name="carregister")
     */
    public function carRegisterAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $username = $this->get('security.token_storage')->getToken()->getUser();
        $cars = $entityManager->getRepository(Car::class)->findAll($username);

        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $user = $entityManager->getRepository(User::class)->find($username);

        $car -> setUsername($user->getUsername());
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            // 4) save the User!
            $entityManager->persist($car);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

        }

        return $this->render(
            'carregister/index.html.twig',
            array('cars' => $cars,'form' => $form->createView())
        );
    }
}
