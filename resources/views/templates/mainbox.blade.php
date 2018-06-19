@extends('templates.template')

@section('content')
    @component('components.box')
        <div class="section">
            @yield('inner')
        </div>
    @endcomponent
@endsection
