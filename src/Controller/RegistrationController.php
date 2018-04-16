<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST) + captcha check
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $this->captchaverify($request->get('g-recaptcha-response'))) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash(
                'notice',
                'Registration successful'
            );
            return $this->redirectToRoute('login');
        }

        #if captcha failed
        if ($form->isSubmitted() && $form->isValid() && !$this->captchaverify($request->get('g-recaptcha-response'))) {

            $this->addFlash(
                'error',
                'Captcha Required'
            );
        }

        return $this->render(
            'registration/index.html.twig',
            array('form' => $form->createView())
        );


    }

    # get success response from recaptcha and return it to controller
    public function captchaverify($recaptcha)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            "secret" => "6LffeFMUAAAAAKZ_gk7CZ0_sv9KouGsEJmJ1tEY_", "response" => $recaptcha));
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response);

        return $data->success;
    }
}