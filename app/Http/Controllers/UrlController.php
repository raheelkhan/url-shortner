<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Services\UrlValidator;
use App\Repositories\RepositoryInterface;

class UrlController extends Controller
{
    /**
     * @var UrlValidator
     */
    private $urlValidator;

    /**
     * @var 
     */
    private $repo;

    /**
     * @param UrlValidator $urlValidator
     */
    public function __construct(UrlValidator $urlValidator, RepositoryInterface $repo)
    {
        $this->urlValidator = $urlValidator;
        $this->repo = $repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        //
    }
}
