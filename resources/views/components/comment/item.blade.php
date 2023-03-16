@props(['comment'])

<x-card>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 text-center">
                <img src="{{ $comment->user->avatar }}" class="img img-thumbnail img-fluid"/>
                <div class="text-secondary">{{ $comment->created_at->format('d.m.Y H:i') }}</div>
            </div>
            <div class="col-md-10">
                <p class="fw-bold float-start">{{ $comment->user->name }}</p>
                @for($i = 1; $i <= $comment->rating; $i++)
                    <span class="float-end"><i class="text-warning fa fa-star"></i></span>
                @endfor
                <div class="clearfix"></div>
                <p>
                    {{ $comment->message }}
                </p>

                {{ $slot }}

            </div>
        </div>
    </div>
</x-card>
