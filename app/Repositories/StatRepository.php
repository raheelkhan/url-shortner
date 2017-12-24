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
        $stat = new Stat();
        $stat->url_id = $data['url_id'];
        $stat->ip_address = $data['ip_address'];
        $stat->user_agent = $data['user_agent'];
        $stat->visited_on = $data['visited_on'];
        $stat->save();
        
        return $stat->toArray();
    }

    /**
     * @param int $id
     * @return array
     */
    public function read(int $id = null): array
    {
        $stat = (($id) ? Stat::find($id) : Stat::all())->toArray();

        return $stat;
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     * @todo Implement functionality
     */
    public function update(int $id, array $data): array
    {
        return [];
    }

    /**
     * @param string $column
     * @param string $value
     * @return array
     * @todo Implement functionality
     */
    public function findBy(string $column, string $value): array
    {
        return [];
    }

    /**
     * @param int $id
     * @return bool
     * @todo Implement functionality
     */
    public function delete(int $id): bool
    {
        return false;
    }
}