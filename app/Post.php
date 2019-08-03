<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Post extends Model
{
    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";
        if(! \is_null($this->image)){
            $imagePath = \public_path() . "/frontend/img/" . $this->image;
            
            if(file_exists($imagePath)){
                $imageUrl = asset("public/frontend/img/". $this->image);
            }
        }
        return $imageUrl;
    }

    public function getDateAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }


    //Cau truc scope dung de su trung khi truy van ben Controller
    public function scopeLatestFirst($query) //su dung o ham index() ben BlogController
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
}
