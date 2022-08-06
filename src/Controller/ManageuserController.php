<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mk_admin/utilisateurs")
 */
class ManageuserController extends AbstractController
{
    /**
     * @Route("/", name="mk_users", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('users/index.html.twig', [
            'users' => $users,
        ]);
    }
    /**
     * @Route("/{id}/ChangeStatus", name="user_change_activationstatus")
     */
    public function ChangeActivationStatus(User $user, UserRepository $userRepository): Response
    {
        /** @var User $user */
        //si l'utilisateur n'est pas connecté
        if (!$user)return $this->json([
            'code' => 403,
            'message' => 'Unauthorized'
        ], 403);

        if ($user->getIsActif() == true){
            $user->setIsActif(false);
        }else{
            $user->setIsActif(true);
        }

        $userRepository->add($user);

        return $this->json([
            'code'      =>200,
            'message'   =>'Statut modifié avec succès!'
        ], 200);
    }
}
