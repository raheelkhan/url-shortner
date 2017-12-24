<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UrlController;
use App\Services\UrlApi;
use App\Exceptions\InvalidUrlException;
use App\Exceptions\UrlNotFoundException;
use Illuminate\Http\RedirectResponse;

class IndexController extends Controller
{
    /**
     * @var UrlApi
     */
    private $api;

    /**
     * @param UrlApi $api
     */
    public function __construct(UrlApi $api)
    {
        $this->api = $api;
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
     * @param string $short_url
     */
    public function route(string $short_url)
    {
        $short_url = env('APP_URL') . $short_url;

        try {
            $url = $this->api->getLongUrl($short_url);
        } catch (UrlNotFoundException $e) {
            abort(404);
        }

        return new RedirectResponse($url);
    }
}
