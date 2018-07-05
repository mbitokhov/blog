@isset($notifications)
<div id="notifications">
    @foreach($notifications as $notification)
        @include('components.notification', $notification)
    @endforeach
</div>
@endisset
