<?php

namespace App\Service;


use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationHelper
{
    /**
     * @var VerifyEmailHelperInterface
     */
    private $verifyEmailHelper;

    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper)
    {

        $this->verifyEmailHelper = $verifyEmailHelper;
    }
    public function generateLinkVerifySignature($userId, $userEmail)
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'verify_email',
            $userId,
            $userEmail,
            [ 'id' => $userId ]
        );

        return $signatureComponents->getSignedUrl();
    }
}