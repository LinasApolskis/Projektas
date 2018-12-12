<?php

namespace App\Controller\Admin;

use App\Form\MassEmailType;
use App\Entity\Currency;
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
        return $this->render('admin/resetPasswordEmail.html.twig');
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
    /**
     * @Route("/admin/massEmail", name="admin_mass_email")
     * @Method({"GET", "POST"})
     */
    public function massEmail(Request $request,  \Swift_Mailer $mailer){

        $form = $this->createForm(MassEmailType::class);
        $form->handleRequest($request);
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $mess = $form->get('message')->getData();
        foreach ($users as $user){

            if ($user) {
                $status = true;
                $message = (new \Swift_Message('Mass email from ADMIN'))
                    ->setFrom('thelincius@gmail.com')
                    ->setTo($user->getEmail())
                    ->setBody(
                        $this->renderView(
                            'admin/massEmailForm.html.twig',
                            array(
                                'message' => $mess,
                                'username' => $user->getUsername()
                            )
                        ),
                        'text/html'

                    );
                $mailer->send($message);
            }
            else
                $status = false;
        }
        return $this->render('admin/massEmail.html.twig', [
            'form'=>$form->createView(),
            'action' => $status
        ]);
    }

	    /**
     *
     * @Route("/admin/updatecurrencies", name="update_currencies")
     * @Method("GET")
     */
    public function updateCurrencies(){


        $jsonContent = file_get_contents("http://www.floatrates.com/daily/eur.json");
        $currencies = json_decode($jsonContent, true);
        $entityManager = $this->getDoctrine()->getManager();
        $status = "Failed";

        $cur = $entityManager->getRepository(Currency::class)->findAll();
        foreach ($cur as $c)
        $entityManager->remove($c);
        $entityManager->flush();
        foreach ($currencies as $currency)
        {

            $currencyObject = new Currency();
            $currencyObject ->setName($currency['name']);
            $currencyObject ->setAlphaCode($currency['alphaCode']);
            $currencyObject ->setCode($currency['code']);
            $currencyObject ->setDate($currency['date']);
            $currencyObject ->setInverseRate($currency['inverseRate']);
            $currencyObject ->setNumericCode($currency['numericCode']);
            $currencyObject ->setRate($currency['rate']);

            $entityManager->persist($currencyObject);
            $entityManager->flush();


            $status = "Success";
            $this->addFlash(
                'notice',
                'Currencies updated successfully'
            );
        }

        return $this->render('admin/updatecurrencies.html.twig');
    }

    /**
     *
     * @Route("/admin/currencies", name="currencies")
     * @Method("GET")
     */
    public function showCurrencies(){

        $entityManager = $this->getDoctrine()->getManager();

        $cur = $entityManager->getRepository(Currency::class)->findAll();

        return $this->render('admin/currencies.html.twig', [
            'currencies' => $cur,
        ]);
    }

}
