@props(['productRating'])

<div {{ $attributes->class(['row']) }}>
    <div class="col-xs-12 col-md-8">
        <div class="bg-light p-3 rounded shadow">
            <div class="row">
                <div class="col-xs-12 col-md-3 pe-0 text-center">
                    <h1 class="rating-num">
                        {{ $productRating['avg'] }}
                    </h1>
                    <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                            @if($productRating['avg'] < $i)
                                <i class="text-warning fa fa-star-o"></i>
                            @else
                                <i class="text-warning fa fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <div>
                        <i class="fa fa-user" aria-hidden="true"></i> {{ $productRating['total'] }} {{ __('отзывов') }}
                    </div>
                </div>
                <div class="col-xs-12 col-md-9 ps-0">
                    <div class="row align-items-center">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="col-xs-3 col-md-4 px-0 text-end">
                                @for($j = $i; $j >= 1; $j--)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </div>
                            <div class="col-md-1 mx-1 px-0 text-center">
                                ({{ ($productRating[$i]['count'] ?? 0) }})
                            </div>
                            <div class="col-xs-8 col-md-6 pe-0">
                                <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="{{ ($productRating[$i]['percentage'] ?? 0) }}"
                                     aria-valuemin="0" aria-valuemax="100">
                                    @switch($i)
                                        @case(5)
                                            <div class="progress-bar progress-bar-striped bg-success" style="width: {{ ($productRating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($productRating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                            @break
                                        @case(4)
                                            <div class="progress-bar bg-success" style="width: {{ ($productRating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($productRating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                            @break
                                        @case(3)
                                            <div class="progress-bar bg-info" style="width: {{ ($productRating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($productRating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                        @case(2)
                                            <div class="progress-bar bg-warning" style="width: {{ ($productRating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($productRating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                        @case(1)
                                            <div class="progress-bar bg-danger" style="width: {{ ($productRating[$i]['percentage'] ?? 0) }}%">
                                                {{ ($productRating[$i]['percentage'] ?? 0) }}%
                                            </div>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
