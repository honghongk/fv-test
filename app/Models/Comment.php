<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    // 기본값
    // const DELETED_AT = 'deleted_at';

    protected $table = 'comments';

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'post_id',
        'user_id',
        'contents',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];


    /**
     * post:comment = 1:N
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }


    /**
     * user:comment = 1:N
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return ?string 작성자 이름
     */
    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }
}
