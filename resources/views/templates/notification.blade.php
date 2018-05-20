@isset($notifications)
@foreach($notifications as $notification)
    @include('components.notification', $notification)
@endforeach
@endisset
