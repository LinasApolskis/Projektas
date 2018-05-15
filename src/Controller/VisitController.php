<?php

namespace App\Controller;

use App\Entity\Visit;
use App\Form\VisitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisitController extends Controller
{

    /**
     * @Route("/visits/new", name="visit_new")
     */
    public function visitCreateAction(Request $request)
    {
        // 1) build the form
        $visit = new Visit();
        $form = $this->createForm(VisitType::class, $visit, array('userid' => $this->get('security.token_storage')->getToken()->getUser()->getID()));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $visit->setUserId($this->get('security.token_storage')->getToken()->getUser());
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($visit);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Visit created successfully'
            );
            return $this->redirectToRoute('car_list');
        }

        return $this->render(
            'web/visit.html.twig',
            array('form' => $form->createView())
        );

    }
}
