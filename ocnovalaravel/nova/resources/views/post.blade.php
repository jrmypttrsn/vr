<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nova Demo</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #eee;
            color: #636b6f;
            font-family: "Nunito", sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-size: 48px;
        }

        blockquote {
            font-style: italic;
        }

        .hero img {
            width: 100%;
        }

        .wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 3%;
            background-color: #fff;
        }

    </style>
</head>
<body>
<div class="wrapper">
    <div class="hero">
        @if ($post->featured_image)
            <img src="{{ $imagePath }}" alt="">
        @endif
    </div>
    <h1>{{ $post->title }}</h1>
    <div class="content">
        {!! $post->content !!}
    </div>
    <p>Published by {{ $post->author->name }} on {{ $post->published_at->format('M j, Y') }} at {{ $post->published_at->format('g:ia') }}</p>
</div>
</body>
</html>