@extends('templates.template')

@section('content')
  <div>
    @foreach(array('darkest', 'darker', 'dark', 'normal', 'light', 'lighter', 'lightest') as $v)
      <div class="box has-shadow-{{ $v }}">
        {{$v}}
      </div>
    @endforeach
    @foreach(array('has-shadow', 'has-no-shadow') as $v)
      <div class="box {{$v}}">
        {{$v}}
      </div>
    @endforeach
  </div>
@endsection
