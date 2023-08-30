<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserPasswordHistory;
use App\Form\ChangePasswordFormType;
use App\Form\ImportFormType;
use App\Repository\UserRepository;
use App\Security\AppCustomAuthenticator;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Service\UserService;
use Symfony\Component\Mailer\MailerInterface;

class UserController extends AbstractController
{
    public function __construct(private UserService $userService, private MailService $mailService, private UserRepository $userRepository)
    {
    }

    #[Route(path: '/', name: 'dashboard')]
    public function dashboard(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->userService->shouldPasswordBeChanged($this->getUser())) {
            return $this->redirectToRoute('userChangePassword');
        }

        return $this->render('user/dashboard.html.twig');
    }

    #[Route(path: '/user/import', name: 'userImport')]
    public function import(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($this->userService->shouldPasswordBeChanged($this->getUser())) {
            return $this->redirectToRoute('userChangePassword');
        }

        $form = $this->createForm(ImportFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('csv')->getData();

            if (($handle = fopen($file->getPathname(), "r")) !== false) {
                $errors = '';
                while (($data = fgetcsv($handle)) !== false) {
                    $skipAdd = false;
                    if (!preg_match('/^(?=(?:\D*\d){2})(?=(?:[^a-z]*[a-z]){2})(?=(?:[^A-Z]*[A-Z]){2})(?=(?:\w*\W){2})/', $data[1])) {
                        $errors .= 'Password for user with email ' . $data[0] . ' does not fulfill password requirements (2 lower case letters, 2 upper case letters, 2 digits and 2 special characters).' . PHP_EOL;
                        $skipAdd = true;
                    }
                    if (!$skipAdd) {
                        $user = $this->userRepository->findOneBy(['email' => $data[0]]);
                        if ($user) {
                            $errors .= 'User with email ' . $data[0] . ' already exists.' . PHP_EOL;
                            $skipAdd = true;
                        }
                    }
                    if (!$skipAdd) {
                        $user = new User();
                        $user->setPassword(
                            $userPasswordHasher->hashPassword(
                                $user,
                                $data[1]
                            )
                        );
                        $user->setFirstLogin(true);
                        $user->setLastPasswordChange(new \DateTime('now'));
                        $user->setEmail($data[0]);
                        $entityManager->persist($user);

                        $userPasswordHistory = new UserPasswordHistory();
                        $userPasswordHistory->setPassword($data[1]);
                        $userPasswordHistory->setUser($user);

                        $entityManager->persist($user);
                        $entityManager->persist($userPasswordHistory);
                    }
                }
                fclose($handle);
                $entityManager->flush();
                if ($errors === '') {
                    return $this->redirectToRoute('dashboard');
                }
            }
        }

        return $this->render('user/import.html.twig', [
            'importForm' => $form->createView(),
            'errors' => $errors ?? '',
        ]);
    }

    #[Route(path: '/user/changePassword', name: 'userChangePassword')]
    public function changePassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppCustomAuthenticator $authenticator, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();
            if ($this->userService->passwordWasAlreadyUsed($user, $plainPassword)) {
                $error = 'This password was already used, please use different';
            }
            if (!isset($error)) {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $plainPassword
                    )
                );
                $user->setFirstLogin(false);
                $user->setLastPasswordChange(new \DateTime('now'));

                $userPasswordHistory = new UserPasswordHistory();
                $userPasswordHistory->setUser($user);
                $userPasswordHistory->setPassword($plainPassword);

                $entityManager->persist($user);
                $entityManager->persist($userPasswordHistory);
                $entityManager->flush();

                $this->mailService->sendMail($user->getEmail(), 'Changed password', 'Your password has been changed successfully', $mailer);

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            }
        }

        return $this->render('user/changePassword.html.twig', [
            'changePasswordForm' => $form->createView(),
            'error' => $error ?? '',
        ]);
    }
}
