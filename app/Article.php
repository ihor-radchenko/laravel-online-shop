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
 */
class Article extends Model
{
    protected $fillable = [
        'title', 'alias', 'text', 'user_id', 'img'
    ];

    public function getImgAttribute(string $value): string
    {
        return '/img/posts/' . $value;
    }

    public function getAliasAttribute(string $value): string
    {
        return '/blog/' . $value;
    }

    public function getCreatedAttribute(): string
    {
        return \DateTime::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('M j, Y');
    }

    public function getShortTextAttribute(): string
    {
        return mb_substr($this->text, 0, 100) . '...';
    }

    public function user()
    {
        return $this->belongsTo('AutoKit\User');
    }
}
