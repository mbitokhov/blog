@extends('templates.template')

@section('content')
    @component('components.box')
        <div class="inner-box">
            <div class="columns">
                <div class="column is-three-quarters">
                    @yield('inner')
                </div>
                <div class="column">
                    @yield('sidebar')
                </div>
            </div>
        </div>
    @endcomponent
@endsection
