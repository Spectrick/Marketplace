<div>
    <div class="border-bottom pb-1 mb-4">
        @isset($link)
            <div class="mb-2">
                {{ $link }}
            </div>
        @endisset

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="h4 m-0">
                    {{ $slot }}
                </h3>
            </div>

            <div class="row">
                @isset($right)
                    <div class="{{ isset($right_2) ? 'col-sm-6' : 'col-sm-12 me-3' }}">
                        {{ $right }}
                    </div>
                @endisset

                @isset($right_2)
                    <div class="col-sm-4 me-1">
                        {{ $right_2 }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
