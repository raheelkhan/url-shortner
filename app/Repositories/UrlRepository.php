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
    public function create(array $data): Url
    {
        $url = new Url();
        $url->url = $data['url'];
        $url->save();
        
        return $url;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Url
     */
    public function update(int $id, array $data): Url
    {
        $url = Url::find($id);
        if ($url) {
            $url->short_url = $data['short_url'];
            $url->save();

            return $url;
        }
    }

    /**
     * @param int $id
     * @return Url|Illuminate\Database\Eloquent\Collection
     */
    public function read(int $id = null)
    {
        $url = (($id) ? Url::findOrFail($id) : Url::all())->toArray();

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
            $urls[] = $url;
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