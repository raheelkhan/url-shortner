<?php

namespace App\Services;

use App\Exceptions\InvalidUrlException;
use App\Repositories\RepositoryInterface;

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
        try {
            if ($this->urlService->validate($url)) {
                $existingUrl = $this->repo->findBy('url', $url);
                if ($existingUrl) {
                    return $existingUrl[0];
                }
                $id = $this->repo->create([
                    'url' => $url
                ])['id'];
                $short_url = $this->urlService->shorten($id);
                $url = $this->repo->update($id, [
                    'short_url' => $short_url
                ]);
                return $url;
            }
        } catch (InvalidUrlException $e) {
            throw new InvalidUrlException($e);
        }
    }

    /**
     * @param int $id
     */
    public function getUrlById(int $id)
    {
        $url = $this->repo->read($id);

        return $url;
    }
}