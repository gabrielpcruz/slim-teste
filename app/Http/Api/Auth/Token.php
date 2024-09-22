<?php

namespace App\Http\Api\Auth;


use Exception;
use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use SlimFramework\Http\Api\ApiAbstractController;
use SlimFramework\Service\Token\AccessToken;

class Token extends ApiAbstractController
{
    /**
     * @var \League\OAuth2\Server\AuthorizationServer
     */
    private AuthorizationServer $authorizationServer;

    /**
     * @var \SlimFramework\Service\Token\AccessToken
     */
    private AccessToken $accessToken;

    /**
     * @param \League\OAuth2\Server\AuthorizationServer $authorizationServer
     * @param \SlimFramework\Service\Token\AccessToken $accessToken
     */
    public function __construct(AuthorizationServer $authorizationServer, AccessToken $accessToken)
    {
        $this->authorizationServer = $authorizationServer;
        $this->accessToken = $accessToken;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \ReflectionException
     */
    public function create(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        $client = $this->accessToken->getClientByGrant($data);

        $payload = [];
        $payload['grant_type'] = $data['grant_type'];
        $payload['client_id'] = $client->getIdentifier();

        if ($data['grant_type'] === 'password') {
            $payload['username'] = $data['username'];
            $payload['password'] = $data['password'];
        }

        if ($data['grant_type'] === 'refresh_token') {
            $payload['refresh_token'] = $data['refresh_token'];
        }

        $request = $request->withParsedBody($payload);

        try {
            return $this->authorizationServer->respondToAccessTokenRequest($request, $response);
        } catch (OAuthServerException $exception) {
            return $exception->generateHttpResponse($response);
        } catch (Exception $exception) {
            $response->getBody()->write($exception->getMessage());

            return $response->withStatus(500);
        }
    }
}
