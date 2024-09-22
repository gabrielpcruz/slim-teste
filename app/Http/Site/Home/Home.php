<?php

namespace App\Http\Site\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimFramework\Http\Site\SiteAbstractController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Home extends SiteAbstractController
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
        $riceService = new RiceService();

        $rices = $riceService->all($request)->toArray();

        return $this->view(
            $response,
            "@site/home/index",
            compact('rices')
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function logged(Request $request, Response $response): Response
    {
        $riceService = new RiceService();

        throw new \Exception("sadasd");
        $rices = $riceService->all()->toArray();

        return $this->view(
            $response,
            "@site/home/logged",
            compact('rices')
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function maintenance(Request $request, Response $response): Response
    {
        return $this->view(
            $response,
            "@site/home/maintenance",
        );
    }
}
