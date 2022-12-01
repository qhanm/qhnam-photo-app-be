<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/***
 * @property integer $id
 * @property string $uuid
 * @property string $path
 * @property string $provider
 * @property integer $size
 * @property string mimetype
 * @property string $extension
 * @property string $created_at
 */
class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
