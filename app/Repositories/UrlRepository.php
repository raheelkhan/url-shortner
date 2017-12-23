<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use App\Url;

class UrlRepository implements RepositoryInterface
{
    /**
     * @param array $data
     * @return Url
     */
    public function create(array $data): array
    {
        $url = new Url();
        $url->url = $data['url'];
        $url->save();
        
        return $url->toArray();
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $url = Url::find($id);
        if ($url) {
            $url->short_url = $data['short_url'];
            $url->save();
            
            return $url->toArray();
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function read(int $id = null): array
    {
        $url = (($id) ? Url::find($id) : Url::all())->toArray();

        return $url;
    }


    /**
     * @param string $column
     * @param string $value
     * @return Url[]
     */
    public function findBy(string $column, string $value): array
    {
        $urls = [];
        foreach (Url::where($column, $value)->cursor() as $url) {
            $urls[] = $url->toArray();
        }

        return $urls;
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