<?php
namespace App\Util;

class Cacher
{
    private string $cacheDir;
    private string $cacheFile;
    private string $cacheKey;
    private string $cacheTimeLimit;
    public function __construct(string $cacheKey = 'no_key')
    {
        $this->cacheDir = realpath(__DIR__ . "/../cache/");
        $this->createCacheDirIfNotExist();
        $this->cacheFile = $this->cacheDir . "/" . $cacheKey;
        $this->cacheKey = $cacheKey;
        $this->cacheTimeLimit = 600;
    }
    
    public function getCachedResponse(): mixed
    {
        $fileExists = file_exists($this->cacheFile);
        if (!$fileExists) return null;

        $lastCacheTime = (time() - filemtime($this->cacheFile));
        if ($lastCacheTime < $this->cacheTimeLimit) {
            
            $response = unserialize(file_get_contents($this->cacheFile));
            return $response;
        }
        return null;
    }

    public function setCacheResponse($response): void
    {
        file_put_contents($this->cacheFile, serialize($response));
    }


    public function setTimeLimit(int $timeLimit): void
    {
        $this->cacheTimeLimit = $timeLimit;
    }

    public function createCacheDirIfNotExist(): void
    {
        if (!file_exists($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function clearCache()
    {
        $files = glob($this->cacheDir . '/*.cache');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}