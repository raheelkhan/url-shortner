<?php

namespace App\Services;

use App\Exceptions\InvalidUrlException;

class UrlService
{
    /**
     * @var string
     */
    private static $chars = "123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";

    /**
     * Returns true if the url is reachable otherwise false
     * 
     * @param string $url
     * @return bool
     * @throws InvalidUrlException
     */
    public function validate(string $url): bool
    {
        if(filter_var($url, FILTER_VALIDATE_URL)) {
            return true;
        }

        throw new InvalidUrlException('Invalid URL');
    }

    /**
     * @param int $id
     * @return string
     */
    public function shorten(int $id): string
    {
        $short_url = rand();

        return $short_url;
    }
}