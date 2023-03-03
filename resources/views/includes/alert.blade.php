@if($alert = session()->pull('alert'))
    @php($type = session()->pull('type'))
    <div class="alert alert-{{ $type }} mb-0 rounded-0 small py-2 text-center">
        {{ $alert }}
    </div>
@endif
