<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova CRM Demo</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex flex-col items-center justify-center md:h-screen md:bg-blue-lightest">
        <form class="w-full max-w-md bg-white rounded p-10 md:shadow" action="/form-submit" method="POST">
            <h1 class="text-grey-darkest mb-8 text-center">Sign Up For Our Nova App</h1>
            {{ csrf_field() }}
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="first-name">
                        First Name
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white {{ $errors->has('first_name') ? 'border-red mb-3' : 'border-grey-lighter' }}" id="first_name" name="first_name" type="text" placeholder="Jane">
                    @if($errors->has('first_name'))
                        <p class="text-red text-xs italic">{{ $errors->first('first_name') }}</p>
                    @endif
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="last-name">
                        Last Name
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey {{ $errors->has('last_name') ? 'border-red mb-3' : 'border-grey-lighter' }}" id="last_name" name="last_name" type="text" placeholder="Doe">
                    @if($errors->has('email'))
                        <p class="text-red text-xs italic">{{ $errors->first('last_name') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-grey {{ $errors->has('email') ? 'border-red mb-3' : 'border-grey-lighter' }}" id="email" name="email" type="email" placeholder="jane@example.com">
                    @if($errors->has('email'))
                        <p class="text-red text-xs italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>
            <button class="block bg-blue px-6 py-4 text-white rounded mx-auto hover:bg-blue-dark" type="submit">Submit</button>
        </form>
        @if (session('form-success'))
            <div class="bg-green mt-8 p-6 rounded shadow">
                <p class="text-white">{{ session('form-success') }}</p>
            </div>
        @endif
    </div>
</body>
</html>