<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use App\Services\UrlService;
use App\Repositories\RepositoryInterface;
use App\Exceptions\InvalidUrlException;

class UrlController extends Controller
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
     */
    public function __construct(UrlService $urlService, RepositoryInterface $repo)
    {
        $this->urlService = $urlService;
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = $this->repo->read();
        
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
                if($this->urlService->validate($url)) {
                    $existingUrl = $this->repo->findBy('url', $url);
                    if ($existingUrl) {
                        return $this->sendOkResponse($existingUrl, 200);
                    }
                    $id = $this->repo->create([
                        'url' => $url
                    ])->id;
                    $short_url = $this->urlService->shorten($id);
                    $url = $this->repo->update($id, [
                        'short_url' => $short_url
                    ]);
                    return $this->sendOkResponse([$url], 200);
                }
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
        $url = $this->repo->read($id);
        
        return $this->sendOkResponse($url, 200);
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
