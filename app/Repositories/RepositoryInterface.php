<?php

namespace App\Repositories;

use App\Url;

interface RepositoryInterface
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function read(int $id = null);

    public function findBy(string $column, string $value): array;

    public function delete(int $id): bool;
}