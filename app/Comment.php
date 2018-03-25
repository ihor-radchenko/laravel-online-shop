<?php

namespace AutoKit;

use Illuminate\Database\Eloquent\Model;

/**
 * AutoKit\Comment
 *
 * @property int $id
 * @property string $name
 * @property string $emails
 * @property int|null $user_id
 * @property int $article_id
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \AutoKit\Article $article
 * @property-read \AutoKit\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property string $email
 */
class Comment extends Model
{
    protected $perPage = 5;

    protected $fillable = [
        'name', 'email', 'user_id', 'article_id', 'text'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getForArticle(Article $article, int $offset = 0)
    {
        return $this
            ->whereArticleId($article->id)
            ->with('user')
            ->orderByDesc('id')
            ->take($this->perPage)
            ->offset($offset * $this->perPage)
            ->get();
    }

    public function getMaxOffset(Article $article): float
    {
        return $article->comments->count() / $this->perPage;
    }
}
