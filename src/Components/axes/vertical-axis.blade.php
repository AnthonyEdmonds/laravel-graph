<g
    class="vertical-axis"
    transform="translate(0, {{ $axis->paddingTop }})"
>
    <text
        class="caption"
        transform="rotate(-90) translate(-{{ $axis->height / 2 }}, 0)"
        x="0"
        y="0"
    >
        {{ $axis->caption }}
    </text>

    @foreach ($axis->labels as $index => $label)
        @if ($index !== count($axis->labels) - 1)
            <line
                class="secondary"
                x1="{{ $axis->width }}"
                x2="{{ $axis->chart->width }}"
                y1="{{ $axis->spacing * $index }}"
                y2="{{ $axis->spacing * $index }}"
            />
        @endif

        <text
            class="label"
            x="{{ $axis->width - $axis->chart::GAP }}"
            y="{{ $axis->spacing * $index }}"
        >
            {{ $label }}
        </text>
    @endforeach
</g>
