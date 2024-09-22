<?php

namespace App\Http\Api\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimFramework\Http\Api\ApiAbstractController;

class Home extends ApiAbstractController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        $riceRepository = new RiceService();

        $this->payloadResponse()->data = $riceRepository->all()->toArray();

        return $this->toJson($response);
    }
}
