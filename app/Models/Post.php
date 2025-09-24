<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    // 기본값
    // const DELETED_AT = 'deleted_at';

    protected $table = 'posts';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'title',
        'contents',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    
    /**
     * user:post = 1:N
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    /**
     * post:comment = 1:N
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * @return ?string 작성자 이름
     */
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }
}
