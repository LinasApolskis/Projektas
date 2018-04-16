<?php

namespace App\Controller;

use App\Form\ChangepasswordType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ChangepasswordController extends Controller
{
    /**
     * @Route("/changepassword", name="changepassword")
     */
    public function changepasswordAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $usernam = $this->get('security.token_storage')->getToken()->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($usernam);

        $forma = $this->createForm(ChangepasswordType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $forma->handleRequest($request);
        if ($forma->isSubmitted() && $forma->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('login');
        }

        return $this->render(
            'changepassword/index.html.twig',
            array('forma' => $forma->createView())
        );
    }
}
