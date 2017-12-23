<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Stat;

class StatRepository implements RepositoryInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return (new Stat())->toArray();
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        return (new Stat())->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function read(int $id = null): array
    {
        return (new Stat())->toArray();
    }


    /**
     * @param string 
     * @return Stat[]
     */
    public function findBy(string $column, string $value): array
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