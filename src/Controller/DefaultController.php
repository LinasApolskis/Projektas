<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('web/index.html.twig', [
            'controller_name' => 'Index',
        ]);
    }
    /**
     * @Route("/AddComment", name="addComment")
     */
    public function addComment()
    {
        return $this->render('web/empty.html.twig', [
            'controller_name' => 'Index',
        ]);
    }

    /**
     * @Route("/ModifyComment", name="modifyComment")
     */
    public function modifyComment()
    {
        return $this->render('web/empty.html.twig', [
            'controller_name' => 'Index',
        ]);
    }

    /**
     * @Route("/Agenda", name="agenda")
     */
    public function agenda()
    {
        return $this->render('web/empty.html.twig', [
            'controller_name' => 'Index',
        ]);
    }
}
