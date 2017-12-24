<?php

namespace App\Services;

use App\Exceptions\InvalidUrlException;
use App\Repositories\RepositoryInterface;
use App\Exceptions\UrlNotFoundException;

class UrlApi
{
    /**
     * @var UrlService
     */
    private $urlService;

    /**
     * @var 
     */
    private $repo;

    /**
     * @param UrlValidator $urlService
     * @param RepositoryInterface $repo
     */
    public function __construct(UrlService $urlService, RepositoryInterface $repo)
    {
        $this->urlService = $urlService;
        $this->repo = $repo;
    }

    /**
     * @return array
     */
    public function getAllUrls()
    {
        $url = $this->repo->read();

        return $url;
    }

    /**
     * @param string $url
     */
    public function saveUrl(string $url)
    {
        if ($this->urlService->validate($url) === false) {
            throw new InvalidUrlException('Invalid Url');
        }
        
        $existingUrl = $this->repo->findBy('url', $url);
        if ($existingUrl) {
            return $existingUrl[0];
        }
        $id = $this->repo->create(['url' => $url])['id'];
        $short_url = (string) $this->urlService->shorten($id);
        $url = $this->repo->update($id, [
            'short_url' => env('APP_URL') . $short_url
        ]);
        return $url;
    }

    /**
     * @param int $id
     * @return string
     */
    public function getUrlById(int $id)
    {
        $url = $this->repo->read($id);

        return $url;
    }

    /**
     * @param string $short_url
     * @return string
     * @throws UrlNotFoundException
     */
    public function getLongUrl(string $short_url): string
    {
        $url = $this->repo->findBy('short_url', $short_url);
        if (!$url) {
            throw new UrlNotFoundException('short url not found');
        }

        return $url[0]['url'];
    }
}