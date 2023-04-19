<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Util\Exception;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Scheb\TwoFactorBundle\Security\TwoFactor\QrCode\QrCodeGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends BaseController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout()
    {
        throw new \Exception('logout() should never be reached.');
    }


    #[Route('/authenticate/2fa/enable', name: '2fa_enable')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function enable2fa(TotpAuthenticatorInterface $totpAuthenticator, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();

        if (!$user->isTotpAuthenticationEnabled()) {
            $user->setTotpSecret($totpAuthenticator->generateSecret());

            $entityManager->flush();
        }

        return $this->render('security/enable_2fa.html.twig');
    }

    #[Route('/authenticate/2fa/qr-code', name: 'qr_code')]
    public function displayGoogleAuthenticatorQrCode(QrCodeGenerator $qrCodeGenerator)
    {
        // $qrCode is provided by the endroid/qr-code library. See the docs how to customize the look of the QR code:
        // https://github.com/endroid/qr-code
        $qrCode = $qrCodeGenerator->getTotpQrCode($this->getUser());

        return new Response($qrCode->writeString(), 200, ['Content-Type' => 'image/png']);
    }
}
