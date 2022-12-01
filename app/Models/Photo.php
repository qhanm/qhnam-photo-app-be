<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/***
 * @property integer $id
 * @property string $uuid
 * @property integer $user_id
 * @property integer $image_id
 * @property string $name
 * @property string $description
 * @property integer $status
 * @property string $created_at
 */
class Photo extends Model
{
    use HasFactory;

    protected $table = 'photo';

    //protected $appends = ['image'];

    protected $with = ['image'];

    public function image() : BelongsTo
    {
        return $this->belongsTo(Image::class);
    }
}
