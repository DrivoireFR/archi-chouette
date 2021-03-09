<?php

namespace App\FileImport;

use Symfony\Component\HttpFoundation\File\File;

class ImageImportService
{
  private const AUTHORIZED_MIME_TYPES = [
    'image/jpeg',
    'image/png',
    'image/webp'
  ];

  public function isValid(File $file): bool
  {
    $mimeType = $file->getMimeType();
    return in_array($mimeType, self::AUTHORIZED_MIME_TYPES);
  }
}
