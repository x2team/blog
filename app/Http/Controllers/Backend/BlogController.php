<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
// use App\Http\Controllers\Controller; //bo dong nay van ok do dc ke thua tu BackendController
use App\Post;
use App\Http\Requests\PostRequest;
use Intervention\Image\Facades\Image;


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
        else{
            $posts = Post::latest()->get();
        }        

        $statusList = $this->statusList();
        return view('backend.blog.index', compact('posts', 'onlyTrashed', 'statusList'));
    }

    private function statusList()
    {
        return [
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
    public function store(PostRequest $request)
    {

        $data = $this->handleRequest($request);

        $request->user()->posts()->create($data);

        return redirect()->route('backend.blog.index')->with('message', 'Your post was created successfully!');
    }

    public function handleRequest($request)
    {
        $data = $request->all();
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;

            //watermark
            $watermark = Image::make($this->watermarkPath."/watermark.png");
            $interventionImage = Image::make($image);
            $successUpload = $interventionImage->insert($watermark, 'bottom-right', 10, 10)->save($destination . "/" . $fileName);

            // $successUpload = $image->move($destination, $fileName);

            if($successUpload){
                $width = config('cms.image.thumbnail.width');
                $heigth = config('cms.image.thumbnail.height');
                $extension = $image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}", "_thumb.{$extension}", $fileName);
                Image::make($destination . '/' . $fileName)
                    ->resize($width, $heigth)
                    ->save($destination . '/' . $thumbnail);
            }

            $data['image'] = $fileName;
        }

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
        return view('backend.blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post     = Post::findOrFail($id);
        $oldImage = $post->image;

        $data     = $this->handleRequest($request);
        $post->update($data);
        if($oldImage !== $post->image){
            $this->removeImage($oldImage);
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

        $this->removeImage($post->image);

        return redirect('/backend/blog?status=trash')->with('message', 'Your post has been deleted successfully');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', 'Your post has been moved from Trash');
    }

    public function removeImage($image)
    {
        if( ! empty($image)){
            $imagePath = $this->uploadPath . '/' . $image;
            $ext = substr(strrchr($image, '.'), 1);
            $thumbnail = str_replace(".{$ext}", "_thumb.{$ext}", $image);
            $thumbnailPath = $this->uploadPath . '/' . $thumbnail;

            if( file_exists($imagePath)) unlink($imagePath);
            if( file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
