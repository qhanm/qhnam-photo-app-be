<?php
namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\IPhotoRepository;
use App\Models\Photo;
use App\Traits\QueryTrait;
use Illuminate\Pagination\LengthAwarePaginator;

class PhotoRepository implements IPhotoRepository
{
    use QueryTrait;

    protected Photo $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function discover()
    {
        $query = Photo::query()->with('image');
        $query->orderBy('created_at', 'DESC');
        $query->limit(10);

        return $query->get();
    }

    public function all(): LengthAwarePaginator
    {
        $query = Photo::query()->with('image');

        $query = $this->preparePaginate($query, request());

        return $this->paginate($query, request());
    }
}
