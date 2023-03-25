<svg
    height="auto"
    id="{{ $id }}"
    viewBox="0 0 {{ ($xAxis['length'] + 2) * 10 }} {{ $yAxis['max'] + 20 }}"
    width="100%"
>
    <style>
        text {
            dominant-baseline: middle;
            font-size: 1px;
            text-anchor: middle;
        }

        /*
            media break based on current width
            g.x-axis-labels > text:nth-child(3n+2),
            g.x-axis-labels > text:nth-child(3n+3) {
                fill: red;
                opacity: 0;
            }
        */
    </style>

    <title role="caption" id="{{ $id }}-title">{{ $caption }}</title>
    <desc id="{{ $id }}-description">{{ $description }}</desc>

    <g aria-hidden="true">
        <g>
            <text x="0" y="0">0%</text>
            <text x="0" y="10">10%</text>
            <text x="0" y="20">20%</text>
            <text x="0" y="30">30%</text>
        </g>

        <g>
            <line x1="5" x2="35" y1="10" y2="10" stroke="#999999" stroke-width="0.1px" />
            <line x1="5" x2="35" y1="20" y2="20" stroke="#999999" stroke-width="0.1px" />
            <line x1="5" x2="35" y1="30" y2="30" stroke="#999999" stroke-width="0.1px" />
        </g>
    </g>

    <g
        aria-colcount="4"
        aria-describedby="{{ $id }}-description"
        aria-labelledby="{{ $id }}-title"
        aria-rowcount="3"
        role="table"
    >
        <g role="rowgroup">
            <g
                aria-rowindex="1"
                role="row"
            >
                <text
                    aria-colindex="1"
                    aria-label=""
                    role="cell"
                    x="0"
                    y="40"
                ></text>

                @foreach($xAxis['keys'] as $index => $key)
                    <text
                        aria-colindex="{{ $index + 2 }}"
                        aria-label="{{ $key }}"
                        role="columnheader"
                        x="{{ ($index + 1) * 10 }}"
                        y="40"
                    >
                        {{ $key }}
                    </text>
                @endforeach
            </g>
        </g>

        <g role="rowgroup">
            @foreach($series as $key => $points)
                <g
                    aria-rowindex="2"
                    role="row"
                >
                    <polyline
                        aria-colindex="1"
                        aria-label="CPU usage"
                        fill="none"
                        points="
                            @foreach($points as $point)
                                {{ $point['x'] }}, {{ $point['y'] }}
                            @endforeach
                        "
                        role="rowheader"
                        stroke="#{{ rand(100000, 999999) }}"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />

                    @foreach($points as $point)
                        <circle
                            aria-colindex="2"
                            aria-label="{{ $point['y'] }}%"
                            cx="{{ $point['x'] }}"
                            cy="{{ $point['y'] }}"
                            r="1.5"
                            role="cell"
                        />
                    @endforeach
                </g>
            @endforeach
        </g>
    </g>
</svg>
