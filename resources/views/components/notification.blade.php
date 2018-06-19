@if( isset($type) && !is_null($type) )
    <div class="notification has-shadow-light is-{{$type}}">
@else
    <div class="notification has-shadow-light is-primary">
@endif

<button class="delete"></button>

{{$info}}

</div>
