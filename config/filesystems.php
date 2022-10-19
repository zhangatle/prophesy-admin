<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'admin' => [
            'driver' => 'local',
            'root' => public_path('uploads'),
            'visibility' => 'public',
            'url' => env('APP_URL').'/uploads',
        ],
        "oss" => [
            "driver"            => "oss",
            "access_key_id"     => env("OSS_ACCESS_KEY_ID"),           // Required, YourAccessKeyId
            "access_key_secret" => env("OSS_ACCESS_KEY_SECRET"),       // Required, YourAccessKeySecret
            "bucket"            => env("OSS_BUCKET"),                  // Required, For example: my-bucket
            "endpoint"          => env("OSS_ENDPOINT"),                // Required, For example: oss-cn-shanghai.aliyuncs.com
            "internal"          => env("OSS_INTERNAL", null),          // Optional, For example: oss-cn-shanghai-internal.aliyuncs.com
            "domain"            => env("OSS_DOMAIN", null),            // Optional, For example: oss.my-domain.com
            "prefix"            => env("OSS_PREFIX", ""),              // Optional, The prefix of the store path
            "use_ssl"           => env("OSS_SSL", false),              // Optional, Whether to use HTTPS
            "reverse_proxy"     => env("OSS_REVERSE_PROXY", false),    // Optional, Whether to use the Reverse proxy, such as nginx
            "options"           => [],                                 // Optional, Add global configuration parameters, For example: [\OSS\OssClient::OSS_CHECK_MD5 => false]
            "macros"            => []                                  // Optional, Add custom Macro, For example: [\App\Macros\ListBuckets::class, \App\Macros\CreateBucket::class]
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
