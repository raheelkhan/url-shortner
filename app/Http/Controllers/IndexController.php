<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UrlController;
use App\Services\UrlApi;
use App\Exceptions\InvalidUrlException;
use Illuminate\Http\Re;

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
        return view('welcome', [
            'data' => $data
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $url = $request->get('url');
        if ($url) {
            try {
                $url = $this->api->saveUrl($url);
                $data = [
                    'short_url' => $url['short_url']
                ];
                return view('success', ['data' => $data]);
            } catch (InvalidUrlException $e) {
                $data = [
                    'error' => $e
                ];
                return view('welcome', ['data' => $data]);
            }            
        }
        $data = [
            'error' => 'Missng URL'
        ];
        return view('welcome', ['data' => $data]);
    }
}
