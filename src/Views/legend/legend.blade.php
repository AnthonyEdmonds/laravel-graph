@use(AnthonyEdmonds\LaravelGraph\Charts\Chart)

<g
    class="legend"
    transform="translate({{ $legend->chart->width - $legend->width }}, {{ ($legend->chart->height / 2) - ($legend->height / 2) }})"
>
    @foreach ($legend->chart->series as $index => $series)
        <rect
            height="{{ Chart::CHARACTER_HEIGHT }}"
            fill="{{ $series->pointColour }}"
            width="{{ Chart::CHARACTER_HEIGHT }}"
            x="{{ Chart::GAP }}"
            y="{{ ((Chart::CHARACTER_HEIGHT + Chart::GAP) * $index) - ((Chart::CHARACTER_HEIGHT) / 2)  - 2}}"
        />

        <text
            class="label"
            x="{{ Chart::GAP + Chart::CHARACTER_HEIGHT + Chart::GAP }}"
            y="{{ (Chart::CHARACTER_HEIGHT + Chart::GAP) * $index }}"
        >{{ $series->label }}</text>
    @endforeach
</g>
