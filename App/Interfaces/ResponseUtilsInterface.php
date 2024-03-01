<?php

namespace App\Interfaces;

use App\Exceptions\ProjectException;
use Nyholm\Psr7\Response;

interface ResponseUtilsInterface
{
    public static function ToJson(array $body): string;

    public static function ErrorTemplate(string $requestToken, string $errorIdentifier, string $message, int $code): Response;

    public static function SuccessTemplate(string $requestToken, ?array $data = null, ?string $message = null): Response;

    public static function FromException(string $requestToken, ProjectException $e): Response;
}
