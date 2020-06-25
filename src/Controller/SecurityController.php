<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\ForgetType;
use Symfony\Component\Mime\Email;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/loginadminnico", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/forgetmdppass", name="forget")
     */
    public function forgetMdp(Request $request, UsersRepository $usersRepository, MailerInterface $mailer, TokenGeneratorInterface $tokenGenerator){
        
        $form = $this->createForm(ForgetType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $donnee = $form->getData();

            $user = $usersRepository->findOneByEmail($donnee['email']);

            if(!$user){
                $this->addFlash('mailInconnue', 'L\'adresse n\'existe pas');

                return $this->redirectToRoute('forget');
            }

            $token = $tokenGenerator->generateToken();

            try{
                $user->setTokenForget($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            }catch(\Exception $e){
                $this->addFlash('warning', 'Une erreur est survenue :' . $e->getMessage());
                return $this->redirectToRoute('login');
            }
            $url = $this->generateUrl('app_reset_password', ['token' => $token] , UrlGeneratorInterface::ABSOLUTE_URL);

            $emailMDP = (new Email())
                ->from('meublesbynicolas@gmail.com')
                ->to($user->getEmail())
                ->subject('Réinitialisation du mot de passe')
                ->text('Réinitialisation du mot de passe')
                ->html('<p>Voici un lien qui te permetra de réinitialiser ton mot de passe</p> <p><a href="'.$url.'">Créer un nouveau mot de passe</a>');
            $mailer->send($emailMDP);
            $this->addFlash('success', 'un email de réinitialisation de mot de passe vous a été envoyer');
            
            return $this->redirectToRoute('login');
        }
        return $this->render('security/forget.html.twig', ['emailForgetform' => $form->createView()]);
    }

    /**
     * @Route("/reset-pass/{token}", name="app_reset_password")
     */
    public function ressetPass($token, Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = $this->getDoctrine()->getRepository(Users::class)->findOneBy(['tokenForget'=>$token]);

        if(!$user){
            $this->addFlash('danger', 'Token I-inconnue');
            return $this->redirectToRoute('login');
        }

        if($request->isMethod('POST')){
            $user->setTokenForget(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('mdpModif', 'Mot de passe modifier avec success');

            return $this->redirectToRoute('login');
        }else{
            return $this->render('security/reset.html.twig', ['token' => $token]);
        }
    }  
}
