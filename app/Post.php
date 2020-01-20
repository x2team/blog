<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published_at', 'category_id', 'image', 'image_path'];
    protected $dates = ['published_at'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }






    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }








    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ?: NULL;
    }

    public function getImageUrlAttribute()
    {
        $imageUrl = "";
        // $directory = config('cms.image.directory');
        $directory = $this->image_path;
        
        if(! \is_null($this->image)){
            $imagePath = \public_path() . "/storage/{$directory}/" . $this->image;
            
            if(file_exists($imagePath)){
                $imageUrl = asset("/storage/{$directory}/". $this->image);
            }
        }
        // dd($imageUrl);
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
    public function getTagsHtmlAttribute()
    {
        $anchors = [];
        foreach($this->tags as $tag){
            $anchors[] = '<a href="'. route('blog.tag', $tag->slug) .'">'. $tag->name .'</a>';
        }

        return implode(", ", $anchors);
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
            return '<span class="badge bg-success">Published</span>';
        }
    }

    public function createTags($tagString)
    {
        $tags = explode(",", $tagString);

        $tagIds = [];

        foreach ($tags as $tag) {
            if(!empty(trim($tag))){
                $newTag = Tag::firstOrCreate(
                    ['name' => ucwords(trim($tag))], ['slug' => Str::slug($tag)]
                );
                
                $tagIds[] = $newTag->id;
            }
            
        }

        $this->tags()->detach();
        $this->tags()->attach($tagIds);
    }




    //Cau truc scope dung de su dung khi truy van ben Controller
    public function scopeLatestFirst($query) //su dung o ham index() ben BlogController ->latestFirst()
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopePublished($query) //->published()->get()
    {
        return $query->where('published_at', '<=', Carbon::now());
    }
    public function scopeScheduled($query) 
    {
        return $query->where('published_at', '>', Carbon::now());
    }
    public function scopeDraft($query)
    {
        return $query->whereNull('published_at');
    }
    public static function archives()
    {
        return static::selectRaw('count(id) as post_count, year(published_at) year, monthname(published_at) month')
                        ->published()
                        ->groupBy('year', 'month')
                        ->orderByRaw('min(published_at) desc')
                        ->get();
    }



    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'asc');
    }

    public function scopeFilter($query, $filter)
    {
        // dd($filter);
        if(isset($filter['month']) && $month = $filter['month']){
            $query->whereMonth('published_at', Carbon::parse($month)->month);
        }
        if(isset($filter['year']) && $year = $filter['year']){
            $query->whereYear('published_at', $year);
        }
        //check if any term entered
        if (isset($filter['term']) && $term = $filter['term']) {
            $query->where(function ($q) use ($term) {
                // $q->whereHas('author', function($qr) use ($term){
                //     $qr->where('name', 'LIKE', "%{$term}%");
                // });
                // $q->orWhereHas('category', function($qr) use ($term){
                //     $qr->where('title', 'LIKE', "%{$term}%");
                // });
                $q->orWhere('title', 'LIKE', "%{$term}%");
                $q->orWhere('excerpt', 'LIKE', "%{$term}%");
            });
        }
    }

    

}
