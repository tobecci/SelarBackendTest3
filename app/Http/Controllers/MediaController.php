<?php

namespace App\Http\Controllers;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use App\Jobs\ProcessConversion;

class MediaController extends Controller
{
    //
    public function index(Request $request)
    {
        $converted_video_file_name = uniqid() . '.m3u8';
        self::convert_file($converted_video_file_name);

        return response([
            'file_name' => $converted_video_file_name
        ], 201);
    }

    public static function convert_file($file_name)
    {
        dispatch(new ProcessConversion($file_name));
        return true;
    }
}
