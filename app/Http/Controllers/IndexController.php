<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UrlController;
use App\Services\UrlApi;
use App\Exceptions\InvalidUrlException;
use App\Exceptions\UrlNotFoundException;
use Illuminate\Http\RedirectResponse;
use App\Repositories\StatRepository;
use App\Repositories\RepositoryInterface;

class IndexController extends Controller
{
    /**
     * @var UrlApi
     */
    private $api;

    /**
     * @var RepositoryInterface
     */
    private $repo;

    /**
     * @param UrlApi $api
     */
    public function __construct(UrlApi $api, RepositoryInterface $repo)
    {
        $this->api = $api;
        $this->repo = $repo;
    }
    
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = [];
        
        return view('welcome', ['data' => $data]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $url = $request->get('url');
        if (!$url) {
            $data = ['error' => 'Missng URL'];
            return view('welcome', ['data' => $data]);
        }
        try {
            $url = $this->api->saveUrl($url);
            $data = ['short_url' => $url['short_url']];
            return view('success', ['data' => $data]);
        } catch (InvalidUrlException $e) {
            $data = ['error' => $e];
            return view('welcome', ['data' => $data]);
        }            
    }

    /**
     * @param string $shortUrl
     */
    public function route(Request $request, string $shortUrl)
    {
        $shortUrl = env('APP_URL') . $shortUrl;

        try {
            $url = $this->api->getLongUrl($shortUrl);
        } catch (UrlNotFoundException $e) {
            abort(404);
        }

        $statsData = [
            'url_id' => $url['id'],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'visited_on' => date('Y-m-d H:i:s')
        ];
        $stat = $this->repo->create($statsData);
        
        return new RedirectResponse($url['url']);
    }
}
