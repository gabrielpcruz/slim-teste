<?php

namespace App\Service\Token;

use SlimFramework\Entity\User\ClientEntity;
use SlimFramework\Repository\User\AccessTokenRepository;
use SlimFramework\Repository\User\ClientRepository;
use SlimFramework\Repository\User\UserRepository;
use SlimFramework\Service\AbstractService;

class AccessToken extends AbstractService

{
    /**
     * @return string
     */
    protected function getRepositoryClass(): string
    {
        return AccessTokenRepository::class;
    }

    /**
     * @param array $data
     *
     * @return ClientEntity|null
     * @throws \ReflectionException
     */
    public function getClientByGrant(array $data): ?ClientEntity
    {
        $grant_type = $data['grant_type'];

        return match ($grant_type) {
            'refresh_token' => $this->getClientByIdentifier($data),
            default => $this->getClientByUserPassword($data),
        };
    }

    /**
     * @param array $data
     *
     * @return object
     */
    private function getClientByUserPassword(array $data): object
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->getRepository(UserRepository::class);

        $user = $userRepository->getUserEntityByCredentials($data);

        return $user->client()->first();
    }

    /**
     * @param array $data
     *
     * @return ClientEntity|null
     */
    private function getClientByIdentifier(array $data): ?ClientEntity
    {
        /** @var ClientRepository $clientRepository */
        $clientRepository = $this->getRepository(ClientRepository::class);

        return $clientRepository->getClientEntityByCredentials(
            $data
        );
    }
}
