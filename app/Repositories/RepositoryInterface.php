<?php

namespace App\Repositories;

use App\Url;

interface RepositoryInterface
{
    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function read(int $id = null): array;

    public function findBy(string $column, string $value): array;

    public function delete(int $id): bool;
}