<?php

return [
    'users' => [
        'host' => 'nginx_users',
        'classname' => \App\Services\Microservice\Users::class
    ],
    'files_uploader' => [
        'host' => 'nginx_files_uploader',
        'classname' => \App\Services\Microservice\FilesUploader::class
    ],
    'files_downloader' => [
        'host' => 'nginx_files_downloader',
        'classname' => \App\Services\Microservice\FilesDownloader::class
    ],
    'reports' => [
        'host' => 'nginx_files_lists',
        'classname' => \App\Services\Microservice\FilesLists::class
    ]
];
