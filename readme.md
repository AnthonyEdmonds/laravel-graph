# Laravel Graph

Add ARIA-accessible graphs to Laravel systems.

Each graph is fully described, keyboard navigable, screen-reader accessible, and provides an alternative HTML table.

## Available graphs

* Line chart

## Usage

Each graph can be created using the provided blade templates, and customised via the attributes.

```html
<x-laravel-graph::line-chart
    caption="Performance over the last day"
    :data="$collection"
    description="Server performance over the last 24 hours"
    horizontal-axis-caption="Time log taken"
    horizontal-axis-key="created_at"
    vertical-axis-caption="CPU usage"
/>
```

### Attributes

| Attribute             | Type        | Default          | Notes                                                                                |
|-----------------------|-------------|------------------|--------------------------------------------------------------------------------------|
| caption               | string      | Required         | The caption for the graph                                                            |
| description           | string      | Required         | A description of what the graph shows                                                |
| data                  | Collection  | Required         | The graph data                                                                       |
| horizontalAxisKey     | string      | Required         | The key in `$data` for the horizontal axis                                           |
| horizontalAxisCaption | string      | Required         | The caption for the horizontal axis                                                  |
| verticalAxisCaption   | string      |  Required        | The caption for the vertical axis                                                    |
| verticalAxisKeys      | array       | null             | Keys must be present in `$data`, automatically fetched from `$data` when null        |
| width                 | int         | 630              | The base width of the graph in pixels                                                |
| height                | int         | 340              | The base height of the graph in pixels                                               |
| id                    | string      | null             | The ID for the graph, automatically generated when null                              |
| verticalAxisUnit      | string      | ''               | The unit of measurement for the vertical axis                                        |      
| verticalAxisMax       | int\|string | null             | The maximum value of the vertical axis, automatically derived from `$data` when null |
| verticalAxisMin       | int\|string | null             | The minimum value of the vertical axis, automatically derived from `$data` when null |
| palette               | Palette     | Palette::Default | The colour palette to use                                                            | 

## Notes

I won't lie, it's a little rough around the edges.

I started work on this back in early 2023, and had to abandon the project.

This initial release gets the line chart over the edge.

The graph is currently hardcoded to the GOV.UK design system.

## Roadmap

* Correct interfaces and abstraction
* Generic html templates
* Bar chart
* Pie chart
