<?php


return [

    'settings' => [
        'httpVersion'                       => '1.1',
        'responseChunkSize'                 => 4096,
        'outputBuffering'                   => 'append',
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails'               => true,
        'addContentLengthHeader'            => true,
        'routerCacheFile'                   => false,
    ]
];