<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
        return $this->created_at->diffForHumans();
    }

    public function scopeLatestFirst()
    {
        return $this->orderBy('created_at', 'desc');
    }
}
