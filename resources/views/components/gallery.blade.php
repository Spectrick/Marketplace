@props(['product', 'imagesUrl'])

<div data-gallery="simple" {{ $attributes }}>
    @php($imagesUrl = (array) json_decode($product->images->url))
    @foreach($imagesUrl as $imageUrl)
        <figure id="image-{{ $loop->iteration }}">
            @if(str_starts_with($imageUrl, 'http'))
                <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:90vh">
            @else
                <img src="{{ '/storage/'.$imageUrl }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:90vh">
            @endif
        </figure>
    @endforeach
    <nav>
        @foreach($imagesUrl as $imageUrl)
            <a href="#image-{{ $loop->iteration }}">
                @if(str_starts_with($imageUrl, 'http'))
                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="col-sm-1">
                @else
                    <img src="{{ '/storage/'.$imageUrl }}" alt="{{ $product->name }}" class="col-sm-1">
                @endif
            </a>
        @endforeach
    </nav>
</div>

@once
    @push('js')
        <script type="text/javascript" src='/js/jquery.simple-gallery.js'></script>
    @endpush
@endonce
