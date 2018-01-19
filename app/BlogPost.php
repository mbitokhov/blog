<?php

namespace App;

use App\Concerns\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends BaseModel
{
    use SoftDeletes, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'picture_name',
        'user',
        'user_id',
        'released'
    ];

    protected $searchable = [
        'title'      => 'blog_posts.title',
        'user_id'    => 'blog_posts.user_id',
        'released'   => 'blog_posts.released',
        'nickname'   => 'users.nickname',
        'first_name' => 'users.first_name',
        'last_name'  => 'users.last_name',
    ];

    protected $dates = [
        'released_at',
        'deleted_at'
    ];

    protected $appends = [
        'user',
        'released'
    ];

    public function scopeUser($query)
    {
        return $query->join('users','users.id','blog_posts.user_id');
    }

    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    public function setUserAttribute(User $user)
    {
        $this->user_id = $user->id;
    }

    public function getReleasedAttribute()
    {
        return ! is_null($this->released_at);
    }

    public function setReleasedAttribute($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
        if(!$value)
        {
            return;
        }
        return $this->released_at = \Carbon\Carbon::now();
    }
}
