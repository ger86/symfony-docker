<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;

class UserService
{
    public function shouldPasswordBeChanged(User $user): bool
    {
        if ($user->isFirstLogin()) {
            return true;
        }
        $dateToCheck = new \DateTime('now');
        $dateToCheck = $dateToCheck->modify('- ' . $_ENV['PASSWORD_CHANGE_INTERVAL'] . ' days');
        return $user->getLastPasswordChange() <= $dateToCheck;
    }

    public function passwordWasAlreadyUsed(User $user, string $plainPassword): bool
    {
        foreach ($user->getUserPasswordHistories() as $password) {
            if ($password->getPassword() === $plainPassword) {
                return true;
            }
        }
        return false;
    }
}
