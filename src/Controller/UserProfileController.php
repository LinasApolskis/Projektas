<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class UserProfileController extends Controller
{

    /**
     *
     * @Route("profile/{id}/edit", name="profile")
     * @Method({"GET", "POST"})
     */
    public function editProfileAction(Request $request, UserProfile $profile): Response
    {

        $form = $this->createForm(UserProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Profile edited');

            return $this->redirectToRoute('index');
        }

        return $this->render('web/profile.html.twig', [
            'profile' => $profile,
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @Route("/profile/{id}/edit2", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editServiceAction(Request $request, User $user): Response
    {

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'User edited');

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('web\useredit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
