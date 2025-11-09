<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Uiscom\CallApiConfig;
use Uiscom\CallApiClient;
use Uiscom\DataApiClient;
use Uiscom\DataApiConfig;

$accessToken = 'put_access_token_here';

$callApi = new CallApiClient(
    new CallApiConfig(null, null, $accessToken)
);
dump($callApi->listCalls());
dump($callApi->metadata());

$dataApi = new DataApiClient(
    new DataApiConfig($accessToken)
);
dump($dataApi->getCallsReport([
    'date_from' => '2025-10-21 00:00:00',
    'date_till' => '2025-10-22 23:59:59',
]));
dump($dataApi->metadata());
