<?php
namespace App\Http\Repositories\Interfaces;

interface IPhotoRepository {
    public function discover();

    public function all();
}
