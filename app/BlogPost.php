<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends BaseModel
{
    protected $fillable = [
        'title',
        'body'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'released_at',
        'deleted_at'
    ];

    protected static function boot()
    {
        static::creating(function (BlogPost $model) {
            do {
                $short_url = Str::random(self::minSizeId());
                $long_url = Str::random(self::maxSizeId());

                $query = BlogPost::where  ('short_url',  $short_url)
                                 ->orWhere('long_url',   $long_url);
            } while ($query->exists());

            $model->short_url = $short_url;
            $model->long_url = $long_url;
        });

        parent::boot();
    }

    public function getUrlAttribute()
    {
        $title = Str::slug($this->title);

        $date  = $this->released_at;
        $year  = $date->year;
        $month = $date->month;
        $day   = $date->day;

        return "/{$year}/{$month}/{$day}/{$title}";
    }

    /**
     * Get the minimum size url for the blogpost
     * 
     * @return int
     */
    protected static function minSizeId()
    {
        return Cache::remember('blog_posts_min_size_id', now()->addDay(), function () {
            // This is a bit complicated. I want there to be at most a 1% chance
            // to generate a same matching id. And there is only 62 characters
            // to choose from (A-Za-z0-9).
            // 
            // ceil(log62($count)) should give us the minimum amount of
            // characters to fit in the amount of blog posts, but since we can
            // only use 1 out of 100, we need to multiple the count by 100
            //
            // We don't really need to do this, since 62 ** 5 is 916,132,832,
            // and we'll have a lot more scaling concerns if we ever reach that
            // level
            $log62 = log(BlogPost::count() * 100, 62);

            // Minimum of 5 characters
            return $log62 < 5 ? 5 : ceil($log62);
        });
    }

    /**
     * Get the maximum size url for the blogpost
     * 
     * @return int
     */
    protected static function maxSizeId()
    {
        return 60;
    }
}
