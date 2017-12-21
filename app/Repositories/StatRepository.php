<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Stat;

class StatRepository implements RepositoryInterface
{
    /**
     * @param array $data
     * @return Url
     */
    public function create(array $data): Stat
    {
        return new Stat();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Url
     */
    public function update(int $id, array $data): Stat
    {
        return new Stat();
    }

    /**
     * @param int $id
     * @return Url[]
     */
    public function read(int $id = null): array
    {
        return [];
    }


    /**
     * @param int $id
     * @return Url[]
     */
    public function findBy(string $column): array
    {
        return [];
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return true;
    }
}