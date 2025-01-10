<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\HasToArray;
use App\Enums\Contracts\Arrayable;

enum AcceptedFileTypes: string implements Arrayable
{
    use HasToArray;

    case Pdf = 'application/pdf';

    case Excel = 'application/vnd.ms-excel';

    case Excel_Xlsx = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    case Word = 'application/msword';

    case Word_Doc = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

    case PowerPoint = 'application/vnd.ms-powerpoint';

    case PowerPoint_Ppt = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';

    case Png = 'image/png';

    case Jpeg = 'image/jpeg';

    case Jpg = 'image/jpg';

    case Gif = 'image/gif';

    case Webp = 'image/webp';

    public static function keys(): array
    {
        return array_keys(self::toArray());
    }
}
