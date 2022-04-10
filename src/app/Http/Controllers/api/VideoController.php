<?php

namespace App\Http\Controllers\api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Video;
use App\Models\VideoHasTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class VideoController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $videos = Video::where('user_id', $user->id)->get();
        return AppHelper::instance()->success($videos);
    }

    public function store(Request $request)
    {
        $messages = [
            'required'=>"El :attribute es obligatorio",
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ], $messages);

        if ($validator->fails()) {
	        return AppHelper::instance()->fail($validator, $request);
        }

        $user = JWTAuth::parseToken()->authenticate();
        $data = $request->only('title', 'description');
        $data['user_id'] =  $user->id;
        $video = Video::create($data);
        foreach($request->tags as $tag)
        {
            $tag_table = Tag::where('name', $tag)->first();
            if($tag_table == null)
            {
                $tag_table = Tag::create([
                    'name' => $tag
                ]);
            }

            VideoHasTag::create([
                'tag_id' => $tag_table->id,
                'video_id' => $video->id
            ]);
        }

        return AppHelper::instance()->success(Video::whereId($video->id)->first());
    }
}
