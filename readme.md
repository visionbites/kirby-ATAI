# Kirby ATAI

A Kirby field plugin to generate alternative text for images using [alttext.ai](https://alttext.ai/).

## Requirements

- Kirby 5+
- An [alttext.ai](https://alttext.ai/) API key

## Install

### Composer

```shell
composer require visionbites/kirby-atai
```

### Download Zip file

Copy plugin folder into `site/plugins`

## Usage

Add a field `atai` to your blueprint where you want to enter the alternative text.

### File blueprint

When used on a file view, the field automatically detects the current file:

```yaml
fields:
  alt:
    type: atai
    label: Alternative text
```

### Page blueprint

On a page view, use the `target` option to specify which files field holds the image:

```yaml
fields:
  image:
    type: files
    max: 1
  alt:
    type: atai
    label: Alternative text
    target: image
```

### Field properties

| Property | Type     | Default   | Description                                                              |
|----------|----------|-----------|--------------------------------------------------------------------------|
| `label`  | `string` | —         | Field label shown in the Panel                                           |
| `target` | `string` | `image`   | Name of the files field to read the image from (page view only)          |

## Options

Set the options in `config.php`:

```php
return [
  'visionbites.kirby-atai' => [
    'api_key'      => 'XXX',
    'reference'    => 'my-project',
    'is_reachable' => false,
  ]
];
```

| Option         | Type   | Default | Description                                                                                                     |
|----------------|--------|---------|-----------------------------------------------------------------------------------------------------------------|
| `api_key`      | string | `null`  | Your API key for alttext.ai (required)                                                                          |
| `reference`    | string | `null`  | A reference sent to alttext.ai with the metadata, e.g. to track usage                                          |
| `is_reachable` | bool   | `false` | If `true`, only the image URL is sent to alttext.ai. If `false`, the full image is sent as base64-encoded data. |

## Development

```bash
npm run dev    # watch mode (kirbyup)
npm run build  # compile for production
npm run lint   # lint with standard
```

## Todos

- [ ] Add option to pass tags
- [ ] Add option to pass manufacturer and product data
- [ ] Implement an option to batch process images
- [ ] Implement an info section to get usage information

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia, animal abuse, violence or any other form of hate speech.
