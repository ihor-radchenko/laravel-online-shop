<?php

namespace AutoKit;

use AutoKit\Events\UserRegistered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * AutoKit\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Comment[] $comments
 * @property-read \Illuminate\Database\Eloquent\Collection|\AutoKit\Review[] $reviews
 * @property int $verified
 * @property string|null $confirm_token
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereConfirmToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AutoKit\User whereVerified($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    protected const EMAIL_CONFIRMED = true;
    protected const EMAIL_NOT_CONFIRMED = false;
    protected const TOKEN_EXPIRED = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'confirm_token', 'verified'
    ];

    protected $dispatchesEvents = [
        'created' => UserRegistered::class
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function confirmEmail()
    {
        $this->verified = self::EMAIL_CONFIRMED;
        $this->confirm_token = self::TOKEN_EXPIRED;
        $this->save();
        return $this;
    }
}
