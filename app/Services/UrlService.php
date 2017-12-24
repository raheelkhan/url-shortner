<?php

namespace App\Services;

use App\Exceptions\InvalidUrlException;

class UrlService
{
    /**
     * Returns true if the url is reachable otherwise false
     * 
     * @param string $url
     * @return bool
     */
    public function validate(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * @param int $id
     * @return string
     */
    public function shorten(int $id): string
    {
        $shortUrl = base_convert($id, 10, 36);

        return $shortUrl;
    }
}