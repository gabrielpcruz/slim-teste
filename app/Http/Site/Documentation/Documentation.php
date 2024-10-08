<?php

namespace App\Http\Site\Documentation;

use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimFramework\Http\Site\SiteAbstractController;
use SlimFramework\Slim;
use Symfony\Component\Yaml\Yaml;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Documentation extends SiteAbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws DependencyException
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request, Response $response): Response
    {
        $apiPath = Slim::container()->get('settings')->get('application.view.path');
        $yamlFile = $apiPath . '/api/documentation.yaml';

        return $this->view(
            $response,
            '@api/swagger',
            [
                'template' => json_encode(Yaml::parseFile($yamlFile)),
                'arroz' => 'arroz',
            ]
        );
    }
}
