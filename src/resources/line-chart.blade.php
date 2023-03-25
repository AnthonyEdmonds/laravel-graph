<svg
    height="auto"
    id="{{ $id }}"
    viewBox="0 0 {{ $width }} {{ $height }}"
    width="100%"
>
    <style>
        text {
            fill: #0b0c0c;
            font-family: "Inter", "Helvetica", "Arial", "sans-serif";
            font-size: 1rem;
        }

        svg > text.caption {
            dominant-baseline: hanging;
            font-size: 1.25rem;
            font-weight: bold;
            text-anchor: middle;
        }

        g.horizontal-axis > text.caption {
            dominant-baseline: ideographic;
            font-weight: bold;
            text-anchor: middle;
        }

        g.horizontal-axis > text.label {
            dominant-baseline: hanging;
            text-anchor: middle;
        }

        g.vertical-axis > text.caption {
            dominant-baseline: hanging;
            font-weight: bold;
            text-anchor: middle;
        }

        g.vertical-axis > text.label {
            dominant-baseline: middle;
            text-anchor: end;
        }

        g.horizontal-axis > line,
        g.vertical-axis > line {
            stroke: #b1b4b6;
        }

        text.strong {
            font-weight: bold;
        }

        text.align-right {
            text-anchor: end;
        }
    </style>

    <title role="caption" id="{{ $id }}-title">{{ $caption }}</title>
    <desc id="{{ $id }}-description">{{ $description }}</desc>

    <text
        class="caption"
        x="{{ $verticalAxis->width + (($width - $verticalAxis->width) / 2) }}"
        y="0"
    >
        {{ $caption }}
    </text>

    <g aria-label="Chart axes">
        {{ $horizontalAxis->render() }}
        {{ $verticalAxis->render() }}
    </g>

    <g aria-label="Chart series">
        @foreach($series as $plot)
            {{ $plot->render() }}
        @endforeach
    </g>
</svg>
