@props(['product_id', 'comment'])

<div class="row">
    <div class="col mt-4">
        <x-form class="py-2 px-4" {{ $attributes }} style="box-shadow: 0 0 10px 0 #ddd;" autocomplete="off">
            <p class="fw-bold">{{ __('Отзыв') }}</p>
            <div class="form-group row">
                <input type="hidden" name="product_id" value="{{ $product_id }}">
                <div class="col">
                    <div class="rate">
                        @if(isset($comment))
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" {{ ($i == $comment->rating ? 'checked' : '') }} id="star{{ $i }}" class="rate" name="rating" value="{{ $i }}"/>
                                <label for="star{{ $i }}" title="{{ $i . ' ' . __('звезды') }}">{{ $i . ' ' . __('звезды') }}</label>
                            @endfor
                        @else
                            @for($i = 5; $i >= 1; $i--)
                                <input type="radio" {{ ($i == 4 ? 'checked' : '') }} id="star{{ $i }}" class="rate" name="rating" value="{{ $i }}"/>
                                <label for="star{{ $i }}" title="{{ $i . ' ' . __('звезды') }}">{{ $i . ' ' . __('звезды') }}</label>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row mt-4">
                <div class="col">
                        <textarea class="form-control" name="message" rows="6"
                                  placeholder="{{ __('Оставьте свой отзыв о товаре') }}" maxlength="200">{{ ($comment->message ?? '') }}</textarea>
                </div>
            </div>

            {{ $slot }}

        </x-form>
    </div>
</div>
