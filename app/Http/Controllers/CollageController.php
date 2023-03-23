<?php

namespace App\Http\Controllers;

use App\Services\CollageService;
use Illuminate\Http\Request;

class CollageController extends Controller
{
    protected $collageService;
    public function __construct(CollageService $collageService)
    {
        $this->collageService = $collageService;
    }

    public function index()
    {

        return view('collage.collage');
    }


    public function updateCollageInformation(Request $request)
    {
       return $this->collageService->updateCollageInformation($request->all());
    }

    public function getCollageList(Request $request)
    {

        return $this->collageService->getCollageList($request);
    }
}
