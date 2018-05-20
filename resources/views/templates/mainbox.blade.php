@extends('templates.template')

@section('content')
    @component('components.box')
        <div class="inner-box">
            @yield('inner')
        </div>
    @endcomponent
@endsection
