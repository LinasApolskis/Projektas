<?php

namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\User;

class AdminController extends Controller
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @Route("/admin/list", name="admin_list_user")
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //$users = $entityManager->getRepository(User::class)->findAll();
        $dql = "SELECT a FROM App\Entity\User a";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('admin/list.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     *
     * @Route("/admin/status/{id}", name="admin_status_user")
     * @Method("GET")
     */
    public function statusAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository(User::class)->find($id);
        if ($user->isEnabled())
            $user->deactivate();
        else
            $user->activate();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_list_user');
    }

    /**
     *
     * @Route("/admin/role/{id}", name="admin_role_user")
     * @Method("GET")
     */
    public function roleAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        //$user = $em->getRepository(User::class)->find($id);
        $roles = array();
        if (in_array("ROLE_USER", $user->getRoles())) {
            $roles[] = "ROLE_ADMIN";
            $user->setRoles($roles);
        } else {
            $roles[] = "ROLE_USER";
            $user->setRoles($roles);
        }
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('admin_list_user');
    }



}
