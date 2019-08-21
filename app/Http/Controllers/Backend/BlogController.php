<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller; //bo dong nay van ok do dc ke thua tu BackendController
use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogController extends BackendController
{
    protected $uploadPath;
    protected $watermarkPath;

    public function __construct()
    {
        parent::__construct();
        
        $this->uploadPath = public_path(config('cms.image.directory'));
        $this->watermarkPath = public_path(config('cms.image.watermarkPath'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = FALSE;
        if(($status = $request->get('status')) && $status == 'trash'){
            $posts = Post::onlyTrashed()->latest()->get();
            $onlyTrashed = TRUE;
        }
        elseif($status == 'published'){
            $posts = Post::published()->latest()->get();
        }
        elseif($status == 'scheduled'){
            $posts = Post::scheduled()->latest()->get();
        }
        elseif($status == 'draft'){
            $posts = Post::draft()->latest()->get();
        }
        elseif($status == 'own'){
            $posts = request()->user()->posts()->get();
        }
        else{
            $posts = Post::latest()->get();
        }        

        $statusList = $this->statusList($request);
        return view('backend.blog.index', compact('posts', 'onlyTrashed', 'statusList'));
    }

    private function statusList($request)
    {
        return [
            'own' => $request->user()->posts()->count(),
            'all' => Post::count(),
            'published' => Post::published()->count(),
            'scheduled' => Post::scheduled()->count(),
            'draft' => Post::draft()->count(),
            'trash' => Post::onlyTrashed()->count(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.blog.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $this->handleRequest2($request);

        $newPost = $request->user()->posts()->create($data);
        
        $newPost->createTags($data['post_tags']);

        return redirect()->route('backend.blog.index')->with('message', 'Your post was created successfully!');
    }

    // public function handleRequest($request)
    // {   
    //     $data = $request->all();
        
    //     if($request->hasFile('image')){
    //         $image = $request->file('image');
    //         $fileName = $image->getClientOriginalName();
    //         $extension = $image->getClientOriginalExtension();

    //         $fileName = Str::slug(str_replace(".{$extension}", "", $fileName));
    //         $fileName = $fileName . "_" . uniqid();

    //         $destination = $this->uploadPath;

            
    //         //watermark
    //         $watermark = Image::make($this->watermarkPath."/watermark.png");
    //         $interventionImage = Image::make($image);
    //         $successUpload = $interventionImage->insert($watermark, 'bottom-right', 10, 10)->save($destination . "/" . $fileName);

    //         // $successUpload = $image->move($destination, $fileName);

    //         if($successUpload){
    //             // $width = config('cms.image.thumbnail.width');
    //             // $heigth = config('cms.image.thumbnail.height');
    //             // $extension = $image->getClientOriginalExtension();
    //             // $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
    //             // Image::make($destination . '/' . $fileName)
    //             //     ->resize($width, $heigth)
    //             //     ->save($destination . '/' . $thumbnail);
    //         }

    //         $data['image'] = $fileName;
    //     }

    //     return $data;
    // }

    public function handleRequest2($request)
    {   
        $data = $request->all();
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();

            $fileName = Str::slug(str_replace(".{$extension}", "", $fileName));
            $fileName = $fileName . "_" . uniqid() . ".{$extension}";

            // $destination = $this->uploadPath;

            
            // insert watermark
            $watermark = Image::make($this->watermarkPath."/watermark.png");
            $interventionImage = Image::make($image);
            $interventionImage->insert($watermark, 'bottom-right', 10, 10)->save();//->save($destination . "/" . $fileName);

            
            $directory = date("Y") . '/' . date("m");
            $image->storeAs($directory, $fileName ,'public', 0775, true);
            

            // Storage::makeDirectory("/{$directory}/", 0777, true);
            // $files = Storage::allFiles($directory);


            $data['image'] = $fileName;
            $data['image_path'] = $directory;
        }

        // dd(asset('/uploads'));
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::findOrFail($id);
        $tags = Tag::pluck('name');
        
        // dd(asset("{$post->image_path}")."/". $post->image);

        return view('backend.blog.edit', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());die;

        $post     = Post::findOrFail($id);
        $oldImage = $post->image;
        $oldImagePath = $post->image_path;

        $data     = $this->handleRequest2($request);
        $a = Str::slug('123');
        $post->update($data);
        $post->createTags($data['post_tags']);

        if($oldImage !== $post->image){
            $this->removeImage($oldImagePath, $oldImage);
        }
        return redirect()->route('backend.blog.index')->with('message', 'Your post was updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id)->delete();
        
        return redirect('/backend/blog')->with('trash-message', ['Your post moved to Trash', $id]);
    }

    public function forceDestroy($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        $this->removeImage($post->image_path, $post->image);
        $post->tags()->detach();//xoa tat ca tag

        return redirect('/backend/blog?status=trash')->with('message', 'Your post has been deleted successfully');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', 'Your post has been moved from Trash');
    }

    public function removeImage($imagePath, $image)
    {
        if( ! empty($image)){
            $imageFilePath = $this->uploadPath . '/' . $imagePath ."/". $image;
            // $ext = substr(strrchr($image, '.'), 1);
            // $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            // $thumbnailPath = $this->uploadPath . '/' . $thumbnail;
            // dd($imageFilePath);
            if( file_exists($imageFilePath)) unlink($imageFilePath);
            // if( file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
