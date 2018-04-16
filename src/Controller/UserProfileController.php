<?php

namespace App\Controller;

use App\Entity\UserProfile;
use App\Form\UserProfileType;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class UserProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function updateAction(Request $request)
    {

        $profile = new UserProfile();
        $form = $this->createForm(UserProfileType::class, $profile);
        $username = $this->get('security.token_storage')->getToken()->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($username);

        $profile -> setUsername($user->getUsername());
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            // 4) save the User!
            $entityManager->merge($profile);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

        }

        return $this->render(
            'user_profile/index.html.twig',
            array('form' => $form->createView())
        );
    }
}
