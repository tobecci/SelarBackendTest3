<?php

namespace App\Http\Controllers;

use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    public function index(Request $request)
    {
        self::convert_file();

        return response([
            'name' => 'tobecci',
            'path' => storage_path()
        ], 201);
    }

    public static function convert_file()
    {
        $video_file_name = 'test_video.mp4';
        $converted_video_file_name = uniqid() . '.m3u8';
        $lowBitrate = (new X264)->setKiloBitrate(480);
        $midBitrate = (new X264)->setKiloBitrate(720);

        \FFMpeg::fromDisk('videos')
            ->open($video_file_name)
            ->exportForHLS()
            ->addFormat($lowBitrate)
            ->addFormat((new X264)->setKiloBitrate(144))
            ->addFormat($midBitrate)
            ->toDisk('converted_videos')
            ->save($converted_video_file_name);
    }
}
