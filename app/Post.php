<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['title', 'desc', 'image', 'user_id'];
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}