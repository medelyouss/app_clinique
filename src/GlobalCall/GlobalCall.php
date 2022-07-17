<?php

namespace App\GlobalCall;

use App\Principal\Auth\UserRepository;
use App\Principal\Repository\OptionsystemRepository;
use App\Principal\Repository\QuizzRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class GlobalCall extends AbstractExtension
{

    private $connectedUser;
    private $user;
    private $option_system;
    private $parameterBag;

    public function __construct(Security $security,
                                UserRepository $userRepository,
                                OptionsystemRepository $optionsystemRepository,
                                RequestStack $requestStack,
                                ParameterBagInterface $parameterBag,
                                Environment $twig)
    {
        $this->connectedUser = $security->getUser();
        $this->option_system = $optionsystemRepository;
        $this->parameterBag = $parameterBag;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getConnectedUser', [$this, 'getConnectedUser']),
            new TwigFunction('getOptionSystem', [$this, 'getOptionSystem']),
            new TwigFunction('getMode', [$this, 'getMode']),
        ];
    }


    public function getConnectedUser()
    {
        $user = $this->user;
        return $user;
    }

    public function getOptionSystem()
    {
        $option_system = $this->option_system;
        return $option_system->getTheLastOne();
    }

    /**
     * Return le mode de l'environnement (Mode "dev" ou mode "prod")
     * @return array|bool|float|int|null|string|\UnitEnum
     */
    public function getMode()
    {
        return $this->parameterBag->get('kernel.environment');
    }

}