<?php

namespace App\Services;

use App\Repositories\CollageRepository;

class CollageService
{

    protected $collageRepository;

    public function __construct(CollageRepository $collageRepository)
    {
        $this->collageRepository = $collageRepository;
    }

    public function updateCollageInformation($data)
    {
      return  $this->collageRepository->updateCollageInformation($data);

    }

    public function getCollageList($request){

      return $this->collageRepository->getCollageList($request);

    }

}
