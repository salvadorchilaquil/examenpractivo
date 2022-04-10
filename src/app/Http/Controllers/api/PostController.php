<?php

namespace App\Http\Controllers\api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostHasTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class PostController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $posts = Post::where('user_id', $user->id)->get();
        return AppHelper::instance()->success($posts);
    }
    public function store(Request $request)
    {
        $messages = [
            'required'=>"El :attribute es obligatorio",
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required|array',
        ], $messages);

        if ($validator->fails()) {
	        return AppHelper::instance()->fail($validator, $request);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $data = $request->only('title', 'description');
        $data['user_id'] =  $user->id;
        $post = Post::create($data);
        foreach($request->tags as $tag)
        {
            $tag_table = Tag::where('name', $tag)->first();
            if($tag_table == null)
            {
                $tag_table = Tag::create([
                    'name' => $tag
                ]);
            }

            PostHasTag::create([
                'tag_id' => $tag_table->id,
                'post_id' => $post->id
            ]);
        }

        return AppHelper::instance()->success(Post::whereId($post->id)->first());


    }

    public function show(Request $request, $post_id)
    {
        return AppHelper::instance()->success(Post::whereId($post_id)->first());
    }
}
