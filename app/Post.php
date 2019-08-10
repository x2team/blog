<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'image'];
    protected $dates = ['published_at'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";
        $directory = config('cms.image.directory');
        if(! \is_null($this->image)){
            $imagePath = \public_path() . "/{$directory}/" . $this->image;
            
            if(file_exists($imagePath)){
                $imageUrl = asset("public/frontend/img/". $this->image);
            }
        }
        return $imageUrl;
    }
    public function getImageThumbUrlAttribute()
    {
        $imageUrl = "";
        $directory = config('cms.image.directory');
        if(! \is_null($this->image)){
            $ext = substr(strchr($this->image, "."), 1); // jpg or png
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $this->image);
            $imagePath = \public_path() . "/{$directory}/" . $thumbnail;
            
            if(file_exists($imagePath)){
                $imageUrl = asset("public/frontend/img/". $thumbnail);
            }
        }
        return $imageUrl;
    }


    public function getDateAttribute(){
        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }

    public function getBodyHtmlAttribute()
    {
        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }
    public function getExcerptHtmlAttribute()
    {
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL;
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "Y/m/d";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicActionLabel()
    {
        if( ! $this->published_at){
            return '<span class="badge bg-warning">Draft</span>';
        }
        elseif($this->published_at && $this->published_at->isFuture()){
            return '<span class="badge bg-info">Schedule</span>';
        }
        else{
            return '<span class="badge bg-info">Published</span>';
        }
    }




    //Cau truc scope dung de su dung khi truy van ben Controller
    public function scopeLatestFirst($query) //su dung o ham index() ben BlogController ->latestFirst()
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query) //->published()
    {
        return $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'asc');
    }

}
