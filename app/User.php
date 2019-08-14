<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBioHtmlAttribute()
    {
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : NULL;
    }

    public function gravatar()
    {
        $email = $this->email;
        $default = 'http://blog/public/frontend/img/author.jpg';

        $size = 100;

        // return  "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

        // $email = $this->email;
        // // $default = "https://www.somewhere.com/homestar.jpg";
        // $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) $this->attributes['password'] = bcrypt($value);
    }

    public function getLabelUserAttribute()
    {
        if($this->hasRole('admin')){
            return '<span class="right badge badge-danger">Administrator</span>';
        }
        elseif($this->hasRole('editor')){
            return '<span class="right badge badge-warning">Supper Moderator</span>';
        }
        else{
            return '<span class="right badge badge-light">User</span>';
        }
    }
}
