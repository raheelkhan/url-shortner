<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Exceptions\InvalidUrlException;
use App\Services\UrlApi;

class UrlController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = $this->api->getAllUrls();
        
        return $this->sendOkResponse($url, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->get('url');
        if ($url) {
            try {
                $url = $this->api->saveUrl($url);
                return $this->sendOkResponse($url);
            } catch (InvalidUrlException $e) {
                return $this->sendErrorResponse($e, 500);
            }            
        }
        
        return $this->sendErrorResponse('Missing URL', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = $this->api->getUrlById((int) $id);
        
        return $this->sendOkResponse($url, 200);
    }
}
