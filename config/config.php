<?php return [
    // This contains the Laravel Packages that you want this plugin to utilize listed under their package identifiers
    'packages' => [
        'alphasnow/aliyun-oss-laravel' => [
            // Service providers to be registered by your plugin
            'providers' => [
                AlphaSnow\LaravelFilesystem\Aliyun\AliyunServiceProvider::class,
            ],

            // Aliases to be registered by your plugin in the form of $alias => $pathToFacade
            'aliases' => [

            ],

            // The namespace to set the configuration under. For this example, this package accesses it's config via config('purifier.' . $key), so the namespace 'purifier' is what we put here
            'config_namespace' => 'filesystems.disks.oss',

            // The configuration file for the package itself. Start this out by copying the default one that comes with the package and then modifying what you need.
            'config' => [
                "driver"            => "oss",
                "access_key_id"     => env("OSS_ACCESS_KEY_ID"),           // 必填, 阿里云的AccessKeyId
                "access_key_secret" => env("OSS_ACCESS_KEY_SECRET"),       // 必填, 阿里云的AccessKeySecret
                "bucket"            => env("OSS_BUCKET"),                  // 必填, 对象存储的Bucket, 示例: my-bucket
                "endpoint"          => env("OSS_ENDPOINT"),                // 必填, 对象存储的Endpoint, 示例: oss-cn-shanghai.aliyuncs.com
                "internal"          => env("OSS_INTERNAL", null),          // 选填, 内网上传地址,填写即启用 示例: oss-cn-shanghai-internal.aliyuncs.com
                "domain"            => env("OSS_DOMAIN", null),            // 选填, 绑定域名,填写即启用 示例: oss.my-domain.com
                "prefix"            => env("OSS_PREFIX", ""),              // 选填, 统一存储地址前缀
                "use_ssl"           => env("OSS_SSL", true),              // 选填, 是否使用HTTPS
                "reverse_proxy"     => env("OSS_REVERSE_PROXY", false),    // 选填, 域名是否使用NGINX代理绑定
                "options"           => [],                                 // 选填, 添加全局配置参数, 示例: [\OSS\OssClient::OSS_CHECK_MD5 => false]
                "macros"            => [
 
                ]
            ],
        ]
    ],
];
