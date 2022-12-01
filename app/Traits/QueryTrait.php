<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

trait QueryTrait {
    public function preparePaginate(Builder $query, Request $request) : Builder
    {
        $query->orderBy(
            $request->get('orderBy', 'id'),
            $request->get('sortBy', 'DESC')
        );

        return $query;
    }

    public function paginate(Builder $query, Request $request): LengthAwarePaginator
    {
        return $query->paginate(
            $perPage = 15, $columns = ['*']
        );
    }
}
