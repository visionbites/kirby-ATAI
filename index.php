<?php

@include_once __DIR__ . '/vendor/autoload.php';

use Kirby\Http\Remote;
use Kirby\Http\Response;

Kirby::plugin('visionbites/kirby-atai', [
	'options' => [
		'api_url' => 'https://alttext.ai/api/v1/images',
		'api_key' => null,
		'reference' => null,
		'is_reachable' => false,
	],
	'fields' => [
		'atai' => require __DIR__ . '/src/fields/atai.php',
	],
	'api' => [
		'routes' => function ($kirby) {
			return [
				[
					'pattern' => 'atai-image',
					'method' => 'POST',
					'action'  => function () use ($kirby) {
						$inputData = $kirby->request()->get();
						$imageUUID = $inputData['image'];
						$image = $kirby->file('file://' . $imageUUID);

						if(!$image) {
							return false;
						}

						$postData = [
							"lang" => $inputData['lang'],
							"image" => [
								"metadata" => [
									"image_id" => $imageUUID,
									"reference" => option('visionbites.kirby-atai.reference'),
									"used_key" => option('visionbites.kirby-atai.api_key'),
									"domain" => $kirby->request()->domain(),
									"language" => $inputData['lang'],
								]
							]
						];
						$is_reachable = option('visionbites.kirby-atai.reachable', false);

						if($is_reachable) {
							$imageUrl = $image->url();
							$postData['image']['url'] = $imageUrl;
						} else {
							$imageData = $image->dataUri();
							$postData['image']['raw'] = preg_replace('#^data:image/[^;]+;base64,#', '', $imageData);
						}

						$result = Remote::request(
							option('visionbites.kirby-atai.api_url'),
							[
								'headers' => [
									'Content-Type' => 'application/json',
									'X-API-Key' => option('visionbites.kirby-atai.api_key'),
								],
								'method' => 'POST',
								'data' => json_encode($postData),
							]
						);

						return Response::json($result->content(), $result->code());
					}
				]
			];
		}
	]
]);
