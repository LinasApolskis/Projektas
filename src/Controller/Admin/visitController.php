<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class visitController extends Controller
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
}