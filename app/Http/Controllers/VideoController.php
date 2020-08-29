<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Events\VideoViewer;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function getVideo(){
        
        $video = Video::first();

        event(new VideoViewer($video));
        return view('videos.video') -> with('video' , $video);
    }
}
