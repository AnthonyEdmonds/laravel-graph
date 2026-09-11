@use(AnthonyEdmonds\LaravelGraph\Enums\Colour)

<figure style="margin-bottom: 10px; margin-left: 0; margin-right: 0;">
    <svg
        aria-labelledby="{{ $id }}-title"
        aria-describedby="{{ $id }}-description"
        aria-details="{{ $id }}-table"
        focusable="false"
        height="auto"
        id="{{ $id }}"
        role="img"
        viewBox="0 0 {{ $width }} {{ $height }}"
        width="100%"
    >
        <style>
            text {
                fill: {{ Colour::BlackPrimary }};
                font-family: "Inter", "Helvetica", "Arial", "sans-serif";
                font-size: 1.2rem;
            }

            svg > text.caption {
                dominant-baseline: hanging;
                font-size: 1.5rem;
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
                stroke: #cecece;
            }

            g.legend > text.label {
                dominant-baseline: middle;
            }

            text.strong {
                font-weight: bold;
            }

            text.align-right {
                text-anchor: end;
            }
        </style>

        <title id="{{ $id }}-title">{{ $caption }}</title>
        <desc id="{{ $id }}-description">{{ $description }}</desc>

        <text
            aria-hidden="true"
            class="caption"
            x="{{ $verticalAxis->width + (($width - $verticalAxis->width - $legend->width) / 2) }}"
            y="0"
        >{{ $caption }}</text>

        <g aria-hidden="true">
            {{ $horizontalAxis->render() }}
            {{ $verticalAxis->render() }}
            {{ $legend->render() }}
        </g>

        <g>
            @foreach($series as $plot)
                {{ $plot->render() }}
            @endforeach
        </g>
    </svg>

    <figcaption class="govuk-body">{{ $description }}</figcaption>

    <details class="govuk-details">
        <summary class="govuk-details__summary">
            <span class="govuk-details__summary-text">View table data</span>
        </summary>

        <div class="govuk-details__text">
            <table class="govuk-table" id="{{ $id }}-table">
                <caption class="govuk-table__caption govuk-table__caption--m">{{ $caption }}</caption>

                <thead class="govuk-table__head">
                <tr class="govuk-table__row">
                    <th scope="col" class="govuk-table__header">{{ $horizontalAxis->caption }}</th>
                    @foreach($series as $plot)
                        <th scope="col" class="govuk-table__header">{{ $plot->label }}</th>
                    @endforeach
                </tr>
                </thead>

                <tbody class="govuk-table__body">
                    @foreach($horizontalAxis->allLabels as $index => $label)
                        <tr class="govuk-table__row">
                            <td class="govuk-table__cell">{{ $label }}</td>
                            @foreach($series as $plot)
                                <td class="govuk-table__cell">
                                    @isset($plot->points[$index])
                                        {{ $plot->points[$index] }}{{$plot->unit}}
                                    @else
                                        -
                                    @endisset
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </details>
</figure>
