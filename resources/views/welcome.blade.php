<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>  القائمة الرئيسية</title>


        @vite('resources/css/app.css')
        <style>
            body {
                background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
                font-family: 'Tajawal', sans-serif;
            }
            .btn {
                background-color: #3b82f6;
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.375rem;
                transition: background-color 0.3s ease;
            }
            .btn:hover {
                background-color: #2563eb;
            }
            h1 {
                font-size: 2.5rem;
                font-weight: bold;
                color: #1e3a8a;
                margin-bottom: 1.5rem;
            }
            p {
                font-size: 1.25rem;
                color: #4b5563;
                margin-bottom: 2rem;
            }
        </style>
    </head>


    <body class="text-center px-8 py-12">
        <div class="max-w-2xl mx-auto">
            <h1>مرحبًا بك في منصة عطلاتي</h1>
            <p>اضغط على الزر أدناه لبدء الاستخدام  .</p>
    
            @if (Route::has('login'))
            <nav class="-mx-3 flex flex-1 justify-end">
                @auth
                    <a
                        href="{{ url('/dashboard') }}"
                        class="btn mt-4 inline-block"
                    >
                        القائمة الرئيسية
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="btn mt-4 inline-block"
                    >
                        تسجيل الدخول
                    </a>
                @endauth
            </nav>
            @endif
        </div>
    </body>
  
</html>
