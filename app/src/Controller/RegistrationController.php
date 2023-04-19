<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\RegistrationHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var RegistrationHelper
     */
    private $registrationHelper;

    public function __construct(RegistrationHelper $registrationHelper)
    {
        $this->registrationHelper = $registrationHelper;
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setStatus('unconfirmed');

            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            $linkVerifySignature = $this->registrationHelper->generateLinkVerifySignature($user->getId(), $user->getEmail());


            // TODO: in a real app, send this as an email!
            $this->addFlash('success', 'Confirm your email at: '.$linkVerifySignature);


            return $this->redirectToRoute('registration_thx');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/registration/thx', name: 'registration_thx')]
    public function registrationThx(): Response
    {
        return $this->render('registration/thx.html.twig');
    }

    #[Route('/verify', name: 'verify_email')]
    public function verify(Request $request, VerifyEmailHelperInterface $verifyEmailHelper, UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $user = $userRepository->find($request->query->get('id'));

        if (!$user) {
            throw $this->createNotFoundException();
        }

        try {
            $verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(),
                $user->getId(),
                $user->getEmail()
            );
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('error', $e->getReason());

            return $this->redirectToRoute('registration_thx');
        }

        $user->setIsVerified(true);
        $user->setStatus(User::USER_STATUS['ACTIVE']);
        $entityManager->flush();

        $this->addFlash('success', 'Account Verified!!! You can now log in :)');

        return $this->redirectToRoute('registration_thx');
    }

    #[Route('/verify/resend', name: 'register_verify_resend_email', methods: ['POST', 'GET'])]
    public function resendVerifiedEmail(Request $request)
    {
        if (!$request->query->get('userId') || !$request->query->get('userEmail')) {
            throw new \Exception('Bad request values');
        }

        //dd($request);
        $userId = $request->query->get('userId');
        $userEmail = $request->query->get('userEmail');

        $generateLinkVerifySignature = $this->registrationHelper->generateLinkVerifySignature($userId, $userEmail);

        return $this->render('registration/resend_verify_email.html.twig', ['linkVerify' => $generateLinkVerifySignature]);
    }
}
