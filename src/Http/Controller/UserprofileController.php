<?php

namespace App\Http\Controller;

use App\Http\Form\ChangePasswordFormType;
use App\Principal\Auth\User;
use App\Principal\Model\ChangePassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserprofileController extends AbstractController
{
    public $passwordEncoder;
    public $manager;

    public function __construct(UserPasswordHasherInterface $passwordEncoder, EntityManagerInterface $manager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->manager = $manager;
    }

    /**
     * @Route("/userprofile", name="website_userprofile")
     * @IsGranted("ROLE_USER")
     */
    public function profile(Request $request): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        /** @var User $user */
        $user = $this->getUser();

        $changepassword = new ChangePassword();
        $form = $this->createForm(ChangePasswordFormType::class, $changepassword );
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            //dd($this->getDoctrine()->getManager()->find(User::class, $this->getUser()->getId()));
            $no_encodepass = $form->get('oldPassword')->getData();
            $user = $this->getUser();
            //$hash = $passwordEncoder->encodePassword($user, $no_encodepass);
            $mpass_a_verifier = $this->passwordEncoder->isPasswordValid($user,$no_encodepass);

            if($mpass_a_verifier === true) {
                $password = $this->passwordEncoder->hashPassword($user, $form->get('password')->getData());
                $user->setPassword($password);
                $this->manager->flush();

                $this->addFlash(
                    'success',
                    'Félicitations, vous avez modifié votre mot de passe !'
                );

            } else {
                $this->addFlash(
                    'danger',
                    'Mot de passe incorrect, réessayer !'
                );

                return $this->redirectToRoute('website_userprofile');
            }
            $this->manager->refresh($this->getUser());
            return $this->redirectToRoute('website_userprofile');
        }

        return $this->render('admin/users/profile.html.twig', [
            'user'                  => $user,
            'form'                  => $form->createView(),
        ]);
    }



}
