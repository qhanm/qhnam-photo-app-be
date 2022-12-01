<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Interfaces\IPhotoRepository;

class PhotoController extends Controller
{
    protected IPhotoRepository $photoRepository;

    public function __construct(IPhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }


    public function discover() {
        return $this->photoRepository->discover();
    }

    public function index() {
        return $this->photoRepository->all();
    }
}
