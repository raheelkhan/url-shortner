<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Stat;

class StatRepository implements RepositoryInterface
{
    /**
     * @param array $data
     * @return Stat
     */
    public function create(array $data): Stat
    {
        return new Stat();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Stat
     */
    public function update(int $id, array $data): Stat
    {
        return new Stat();
    }

    /**
     * @param int $id
     * @return Stat
     */
    public function read(int $id = null): Stat
    {
        return new Stat();
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