<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // update reply_count when new reply is added to the topic
        // then update the updated_at attr
        // order by updated_at
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // orderby time
        return $query->orderBy('created_at', 'desc');
    }
}
