<g
    class="horizontal-axis"
    transform="translate({{ $axis->paddingLeft }}, {{ $axis->chart->height - $axis->height }})"
>
    <line
        class="primary"
        x1="0"
        x2="{{ $axis->width }}"
        y1="0"
        y2="0"
    />

    <text
        class="caption"
        x="{{ $axis->width / 2 }}"
        y="{{ $axis->height }}"
    >
        {{ $axis->caption }}
    </text>

    @foreach ($axis->labels as $index => $label)
        <line
            class="primary"
            x1="{{ ($axis->spacing * $index) + ($axis->spacing / 2) }}"
            x2="{{ ($axis->spacing * $index) + ($axis->spacing / 2) }}"
            y1="0"
            y2="{{ $axis->chart::GAP }}"
        />

        <text
            class="label"
            x="{{ ($axis->spacing * $index) + ($axis->spacing / 2) }}"
            y="{{ $axis->chart::GAP * 2 }}"
        >
            {{ $label }}
        </text>
    @endforeach
</g>
