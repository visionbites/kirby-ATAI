# Kirby ATAI
A Kirby field plugin to generate alternative text for images using [alttext.ai](https://alttext.ai/).

You need to have and enter a valid API-Key 


## Install
### Download Zip file

Copy plugin folder into `site/plugins`

### Composer
```shell
composer require visionbites/kirby-atai
```

## Usage
Add a field `atai` to your image blueprint where you want to enter the alternative text.


### Example
Basic setup:

```yaml
fields:
    alt:
        type: atai
        label: Alternative text
```


## Options

there are only two options at the moment:

| Option         | Default | Description                                                                                                                                 |
|----------------|---------|---------------------------------------------------------------------------------------------------------------------------------------------|
| `api_key`      | `null`  | Your api key for alttext.ai                                                                                                                 |
| `reference`    | `null`  | a reference to that is sent to alttext.ai with the metadata. Can be used e.g. to track usage                                                |
| `is_reachable` | `false` | if the site is reachable from the internet. If yes only the images Url will be posted to alttext.ai. If not the whole image will be posted. |


set the options in `config.php`:

```php
return [
	'visionbites.kirby-atai' => [
		'api_key' => 'XXX',
		'reference' => 'my-project',
		'is_reachable' => false,
	]
];
```


## todos
- [ ] add option to pass tags
- [ ] add option to pass manufacturer and product data
- [ ] implement an option to batch process images
- [ ] implement an info section to get usage information

## License

[MIT](https://opensource.org/licenses/MIT)

It is discouraged to use this plugin in any project that promotes racism, sexism, homophobia animal abuse, violence or any other form of hate speech.
