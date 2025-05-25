<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Management System</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" rel="stylesheet">
        @vite(['resources/js/app.js','resources/css/app.css'])
</head>
<body class="min-vh-100 d-flex flex-column">
    <div>
        <nav class="navbar navbar-dark bg-dark d-flex justify-content-between p-3">
            <a class="navbar-brand fs-2 p-3" href="#">Gestion de stock</a>
            <select name="selectLang" id="selectLang" class="btn btn-light">
                <option @if(app()->getLocale() == 'ar') selected @endif value="ar">ar</option>
                <option @if(app()->getLocale() == 'fr') selected @endif value="fr">fr</option>
                <option @if(app()->getLocale() == 'en') selected @endif value="en">en</option>
                <option @if(app()->getLocale() == 'es') selected @endif value="es">es</option>
            </select>
            <a href="{{route('email.form')}}" class="btn btn-success">Send Email</a>
        </nav>
    </div>
    
    
    <div class="container flex-grow-1 py-4">
        @yield('content')
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#selectLang").on('change',function(){
            var locale = $(this).val();
            window.location.href = "/changeLocale/"+locale;
        })
    </script>

    
    @stack('script')

    <div>
        <div class="bg-dark text-center text-light" style="height: 40px">&copy; copyright 2025</div>
    </div>
</body>
</html>