<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title','Login' )</title>
        <link rel="icon" href="{{ url('assets/assets/img/JM.png') }}" type="image/png"/>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            /* General Body Style */
            body {
                background: white;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                font-family: 'Arial', sans-serif;
            }
        
            /* Login Wrapper */
            .login-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                width: 100%;
            }
        
            /* Login Container */
            .login-container {
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
                padding: 2rem;
                position: relative;
                text-align: center;
            }
        
            /* Loading Overlay */
            .loading-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                display: none;
                z-index: 10;
                border-radius: 12px;
            }
        
            .loading-overlay.active {
                display: flex;
            }
        
            .loading-overlay .spinner {
                border: 4px solid rgba(0, 0, 0, 0.1);
                border-radius: 50%;
                border-top: 4px solid #6e8efb;
                width: 60px;
                height: 60px;
                animation: spin 1s linear infinite;
            }
        
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        
            /* Form Title */
            .login-form h2 {
                margin-bottom: 1rem;
                font-size: 2rem;
                color: #333;
            }
        
            /* Form Group */
            .form-group {
                margin-bottom: 1.5rem;
                position: relative;
            }
        
            .form-group label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: #555;
                font-size: 1rem;
            }
        
            .form-group input {
                width: 100%;
                padding: 0.75rem;
                border: 1px solid #ddd;
                border-radius: 8px;
                font-size: 1rem;
                transition: border-color 0.3s, box-shadow 0.3s;
            }
        
            .form-group input:focus {
                border-color: #6e8efb;
                box-shadow: 0 0 0 3px rgba(110, 145, 237, 0.2);
                outline: none;
            }
        
            .error-message {
                color: #e3342f;
                font-size: 0.875rem;
                position: absolute;
                bottom: -1.5rem;
                left: 0;
                width: 100%;
            }
        
            /* Submit Button */
            .btn-primary {
                background-color: #6e8efb;
                color: white;
                padding: 1rem;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                width: 100%;
                font-size: 1.125rem;
                transition: background-color 0.3s, transform 0.3s;
            }
        
            .btn-primary:hover {
                background-color: #5a77f1;
                transform: scale(1.05);
            }
        </style>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <img class="w-200 h-20 fill-current text-gray-500" src="{{ asset('assets/image/logo JM.jpeg') }}"/>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" >
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
{{-- style=" background: rgb(21, 136, 67);" --}}