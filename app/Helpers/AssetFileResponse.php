<?php

declare(strict_types=1);

namespace App\Helpers;

use Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class AssetFileResponse
{
    public function __construct(
        protected readonly string $filename,
        protected readonly bool $autoDiscover = true,
    ) {
        //
    }

    public static function make(string $filename, bool $autoDiscover = true): self
    {
        return new self($filename, $autoDiscover);
    }

    public function toFileResponse(): BinaryFileResponse
    {
        $filePath = $this->getFilePath();

        return  response()->file($filePath, [
            'Content-Type'   => $this->getContentType(),
            'Cache-Control'  => 'public, max-age=3600, immutable',
            'Content-Length' => filesize($filePath),
            'Version'        => md5_file($filePath),
        ]);
    }

    private function getFilePath(): string
    {
        $manifestFile = public_path('build/manifest.json');

        throw_unless(file_exists($manifestFile), new Exception('Manifest file not found.'));

        $manifestContent = file_get_contents($manifestFile);

        $manifestData = json_decode($manifestContent, true);

        $path = 'resources/'.($this->autoDiscover ? $this->getFilenameWithAutoDiscover() : $this->filename);

        throw_unless(array_key_exists($path, $manifestData), new Exception('File not found in manifest.'));

        return public_path('build/'.$manifestData[$path]['file']);
    }

    private function getFileExtension(): string
    {
        return pathinfo($this->filename, PATHINFO_EXTENSION);
    }

    private function getFilenameWithAutoDiscover(): string
    {
        return $this->getFileExtension().'/'.$this->filename;
    }

    private function getContentType(): string
    {
        return match ($this->getFileExtension()) {
            'js' => 'application/javascript',
            'css' => 'text/css',
            default => throw new Exception('File type not supported.'),
        };
    }
}
