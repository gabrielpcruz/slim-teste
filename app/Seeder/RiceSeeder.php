<?php

namespace App\Seeder;

use DateTime;
use DI\DependencyException;
use DI\NotFoundException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use SlimFramework\Seeder\AbstractSeeder;

class RiceSeeder extends AbstractSeeder
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws NotFoundException
     * @throws ContainerExceptionInterface
     * @throws DependencyException
     */
    public function run(): void
    {
        for ($i = 1; $i < 100; $i++) {
            $id = uniqid();

            $this->connection()->table('rice')->insert([
                'name' => "rice_{$id}",
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ]);
        }
    }
}
