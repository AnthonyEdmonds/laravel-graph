@use(AnthonyEdmonds\LaravelGraph\Enums\PointType)

<g
        aria-label="{{ $series->label }}"
        role="img"
        transform="translate({{ $series->paddingLeft }}, {{ $series->paddingTop }})"
>
    @if($series->showLine === true)
        <polyline
                fill="none"
                stroke="{{ $series->lineColour }}"
                stroke-width="{{ $series->strokeWidth }}"
                points="{{ $series->pointsAsPolyline() }}"
        />
    @endif

    @foreach($series->points as $key => $value)
        @if($series->showText === true)
            <text
                    fill="{{ $series->textColour }}"
                    text-anchor="middle"
                    x="{{ $series->positionFor($key, 'x', 'text') }}"
                    y="{{ $series->positionFor($value, 'y', 'text') }}"
            >{{ $value }}{{ $series->unit }}</text>
        @endif

        @if($series->showPoint === true)
            @if($series->pointShape === PointType::Circle)
                <circle
                        aria-label="{{ $series->descriptionFor($key, $value) }}"
                        cx="{{ $series->positionFor($key, 'x') }}"
                        cy="{{ $series->positionFor($value, 'y') }}"
                        fill="{{ $series->pointColour }}"
                        r="{{ $series->pointSize }}"
                        role="img"
                        tabindex="0"
                />
            @else
                <rect
                        aria-label="{{ $series->descriptionFor($key, $value) }}"
                        height="{{ $series->pointSize * 2 }}"
                        fill="{{ $series->pointColour }}"
                        role="img"
                        tabindex="0"
                        width="{{ $series->pointSize * 2 }}"
                        x="{{ $series->positionFor($key, 'x') }}"
                        y="{{ $series->positionFor($value, 'y') }}"
                />
            @endif
        @endif
    @endforeach
</g>
