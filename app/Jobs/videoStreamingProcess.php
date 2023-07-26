<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Exporters\HLSVideoFilters;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use App\Models\Video;
use App\Models\Videos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Str;

class videoStreamingProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $fileName;
    protected $title;
    protected $path;
    protected $id;
    protected $quality;
    public function __construct($id)
    {
        $this->id = $id;
        // $this->title = $title;
        // $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $lowBitrate = (new X264)->setKiloBitrate(250);
        $midBitrate = (new X264)->setKiloBitrate(500);
        $highBitrate = (new X264)->setKiloBitrate(1000);
        $superBitrate = (new X264)->setKiloBitrate(1500);

        $qualities = [
            [
                "name" => "1080",
                "formate" => $highBitrate,
                "x" => 1920,
                "y" => 1080
            ],
            [
                "name" => "720",
                "formate" => $highBitrate,
                "x" => 1280,
                "y" => 720
            ],
            [
                "name" => "480",
                "formate" => $highBitrate,
                "x" => 854,
                "y" => 480
            ],
            // [
            //     "name" => "360",
            //     "formate" => $highBitrate,
            //     "x" => 640,
            //     "y" => 360
            // ],
            // [
            //     "name" => "240",
            //     "formate" => $highBitrate,
            //     "x" => 426,
            //     "y" => 240
            // ]
        ];
        $video = Videos::where('id', $this->id)->first();
        $this->path = $video->video_path;
        $key = Str::random(20) . Carbon::now()->timestamp;
        $this->title = $this->replace_string_space($video->title) . "_" . Carbon::now()->timestamp;
        $links = [];
        foreach ($qualities as $quality) {
            $links[] = $this->process_video($quality);
        }
        Videos::where('id', $this->id)->update(['hashed_key' => $key, 'hashed' => 1, 'hashed_links' => $links]);
    }

    public function process_video($quality)
    {
        $this->quality = $quality;
        try {
            FFMpeg::fromDisk('local')
                ->open($this->path)
                ->exportForHLS()
                ->withRotatingEncryptionKey(function ($filename, $contents) {
                    Storage::disk('public')->put("videos/{$this->title}/{$this->quality['name']}/{$filename}", $contents);
                })
                ->addFormat($this->quality['formate'], function (HLSVideoFilters $filters) {
                    $filters->resize($this->quality['x'], $this->quality['y']);
                })->toDisk('public')
                ->save("videos/{$this->title}/{$this->quality['name']}/video.m3u");
            return [
                'link' => "videos/" . $this->title . "/" . $this->quality['name'] . "/video.m3u",
                'label' => $this->quality['name']
            ];
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function replace_string_space($title)
    {
        $arr = explode(" ", $title);
        $string = implode("_", $arr);
        return $string;
    }
    public function encrypt()
    {
        $key = Str::random(20) . Carbon::now()->timestamp;
        $encrypted = Crypt::encryptString($key);
        return $encrypted;
    }
}
