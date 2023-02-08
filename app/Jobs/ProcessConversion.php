<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;

class ProcessConversion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file_name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file_name)
    {
        //
        $this->file_name = $file_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        info("**** filename { $this->file_name }");
        $video_file_name = 'test_video.mp4';
        $lowBitrate = (new X264)->setKiloBitrate(480);
        $midBitrate = (new X264)->setKiloBitrate(720);

        \FFMpeg::fromDisk('videos')
            ->open($video_file_name)
            ->exportForHLS()
            ->addFormat($lowBitrate)
            ->addFormat($midBitrate)
            ->toDisk('converted_videos')
            ->save($this->file_name);
    }
}
