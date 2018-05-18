<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\resetPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends Controller
{
    /**
     * @Route("/reset/password", name="reset_password")
     * @Method({"GET", "POST"})
     */
    public function PasswordReset(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $passwordEncoder)
    {

        $error="";
        $form = $this->createForm(resetPasswordType::class);
        $form->handleRequest($request);
        $email = $form -> getData();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email['email']]);
        if ($user)
        {
            $bytes = random_bytes(5);
            $newPassword = bin2hex($bytes);
            $password = $passwordEncoder->encodePassword($user, $newPassword);
            $user -> setPassword($password);

            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $message = (new \Swift_Message('Password reset link'))
                ->setFrom('thelincius@gmail.com')
                ->setTo($email['email'])
                ->setBody(
                    $this->renderView(
                            'reset_password/resetPasswordEmail.html.twig',
                            array(
                                'token' => $newPassword,
                                'username' => $user->getUsername()
                            )
                    ),
                    'text/html'

                );
            $mailer->send($message);
            $this->addFlash(
                'notice',
                'Email has been sent!'
            );
        }
        else
            $this->addFlash(
                'notice',
                'Your email was not found in our database'
            );
        ;



        return $this->render('web/resetPassword.html.twig', [
            'form'=>$form->createView(),
            'action' => "reset",
            'error'=>$error,
        ]);
    }

}
