<?php

namespace App\Security\Voter;

use App\Entity\Doc;
use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use function PHPUnit\Framework\throwException;

class DocVoter extends Voter
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['EDIT'])
            && $subject instanceof \App\Entity\Doc;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {

        /** @var User $user */
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (!$subject instanceof Doc) {
            throw new \Exception('Wrong type somehow passed');
        }

        if ($this->security->isGranted('ROLE_EDIT_DOC')) {
            return true;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'EDIT':
                return $user === $subject->getOwner();
        }

        return false;
    }
}
