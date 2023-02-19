<?php

namespace Wpjscc\Oss\OssMacro;


use Closure;
use AlphaSnow\LaravelFilesystem\Aliyun\Macros\AliyunMacro;
use OSS\OssClient;
use RuntimeException;
use Cache;
use Config;

/**
 * 资源包不支持
 * @see https://help.aliyun.com/document_detail/173537.html
 */
class DownloadUrl implements AliyunMacro
{

    /**
     * @return string
     */
    public function name(): string
    {
        return "getDownloadUrl";
    }

    /**
     * @return Closure
     */
    public function macro(): Closure
    {
        return function (string $path, $prefix = 'backend.resize.file') {
            // Check to see if the URL has already been generated
            $pathKey = $prefix .':' . $path;
            $url = Cache::get($pathKey, null);

            if (is_null($url) && $this->exists($path)) {
                $expires = now()->addSeconds(Config::get('cms.storage.resize.temporaryUrlTTL', 3600));
                $url = Cache::remember($pathKey, $expires, function () use ($path, $expires) {
                    // Attempt to generate a temporary URL, if a RuntimeException occurs it's "probably"
                    // because the driver doesn't support that method
                    try {
                        return $this->temporaryUrl($path, $expires);
                    } catch (RuntimeException $ex) {
                        return false;
                    }
                });
            }
            // Limit the return types to strings or null
            if (!is_string($url) || empty($url)) {
                $url = null;
            }
            return $url;
        };
    }
}
