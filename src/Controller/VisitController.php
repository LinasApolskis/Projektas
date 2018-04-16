<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Visit;
use App\Form\VisitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisitController extends Controller
{
    /**
     * @Route("/visit", name="visit")
     */
    public function index(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $username = $this->get('security.token_storage')->getToken()->getUser();
        $visits = $entityManager->getRepository(Visit::class)->findAll($username);
        $cars = $entityManager->getRepository(Car::class)->findAll($username);

        $visit = new Visit();
        $form = $this->createForm(VisitType::class, $visit);


        $visit->setUsername($username);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $visit->getLicence() === $cars->getLicence()) {

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visit);
            $entityManager->flush();
        }
        return $this->render(
            'visit/index.html.twig',
            array('visits' => $visits, 'form' => $form->createView())
        );
    }
}
