<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $video->title }}</title>

        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
        <link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <div class="max-w-6xl w-full mx-auto sm:px-6 lg:px-8">

                <video-js id="hashed_video" class="vjs-default-skin vjs-big-play-centered" controls preload="auto" data-setup='{"fluid": true,"playbackRates": [0.5, 1, 1.5, 2]}'>
                    @foreach ($links as $link )
                        <source src="/storage/{{$link['link']}}" type="application/x-mpegURL" label="{{$link['label']}}">
                    @endforeach
                </video-js>

               <!-- <script src="https://unpkg.com/video.js/dist/video.js"></script> -->
                <script src="{{ asset('js/video.js') }}" ></script>
                <script src="{{ asset('js/videojs-playbackrate-adjuster.js') }}" ></script>
                <script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>
                <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>

                <script>
                    var player = videojs('hashed_video');
                    player.controlBar.addChild('QualitySelector');
                </script>
            </div>
        </div>
    </body>
</html>
