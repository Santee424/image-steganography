<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('inc.header')

<body>
    
    <div id="app">
        @include('inc.navbar')
        	@yield('content')
       	@include('inc.footer')
    </div>
</body>
</html>
