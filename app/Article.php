<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

/**
 * AutoKit\Article
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $text
 * @property int $user_id
 * @property string $img
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Article whereUserId($value)
 * @mixin \Eloquent
 * @property-read mixed $created
 * @property-read \AutoKit\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Comment[] $comments
 */
class Article extends Model
{
    protected $perPage = 3;

    protected $fillable = [
        'title', 'alias', 'text', 'user_id', 'img'
    ];

    public function getImgAttribute(string $value): string
    {
        return '/images/posts/' . $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLastForMainPage()
    {
        return $this
            ->with('user')
            ->withCount('comments')
            ->orderByDesc('id')
            ->take(3)
            ->get();
    }

    public function getForBlog()
    {
        return $this
            ->with('user')
            ->withCount('comments')
            ->orderByDesc('id')
            ->paginate();
    }
}
