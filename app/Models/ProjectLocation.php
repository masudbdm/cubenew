<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'addedby_id',
        'editedby_id',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
