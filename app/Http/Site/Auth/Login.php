<?php

namespace App\Http\Site\Auth;


use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimFramework\Entity\User\UserEntity;
use SlimFramework\Http\Site\SiteAbstractController;
use SlimFramework\Repository\User\UserRepository;
use SlimFramework\Session\Session;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Login extends SiteAbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request, Response $response): Response
    {
        return $this->view(
            $response,
            "@site/login/index",
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws ContainerExceptionInterface
     * @throws DependencyException
     * @throws NotFoundException
     * @throws NotFoundExceptionInterface
     */
    public function login(Request $request, Response $response): Response
    {
        $data = (array) $request->getParsedBody();

        /** @var UserRepository $userRepository */
        $userRepository = $this->getRepositoryManager()->get(UserRepository::class);

        /** @var UserEntity $user */
        $user = $userRepository->getUserEntityByCredentials($data);

        if ($user) {
            Session::user($user);

            $this->flash()->addMessage('sadsad', 'asdsad');
        }

        return redirect('/logged');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function logout(Request $request, Response $response): Response
    {
        Session::logout();

        return redirect('/login');
    }
}
