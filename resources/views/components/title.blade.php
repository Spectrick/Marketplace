<div>
    <div class="border-bottom pb-3 mb-4">
        @isset($link)
            <div class="mb-2">
                {{ $link }}
            </div>
        @endisset

        <div class="d-flex justify-content-between">
            <div>
                <h2 class="h2 m-0">
                    {{ $slot }}
                </h2>
            </div>

            <div class="row">
                @isset($right)
                    <div class="col-xs-6 me-3">
                        {{ $right }}
                    </div>
                @endisset

                @isset($right_2)
                    <div class="col-xs-6 me-3">
                        {{ $right_2 }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
