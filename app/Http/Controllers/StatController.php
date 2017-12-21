<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Http\Request;
use App\Repositories\RepositoryInterface;

class StatController extends Controller
{
    /**
     * @var RepositoryInterface
     */
    private $repo;

    public function __construct(RepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
}
