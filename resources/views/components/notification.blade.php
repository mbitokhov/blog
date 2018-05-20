@if( isset($type) && !is_null($type) )
    <div class="notification is-{{$type}}">
@else
    <div class="notification is-primary">
@endif
<button class="delete"></button>

{{$info}}

</div>
