<?php

declare(strict_types=1);

namespace OpenBreweryDb\Exceptions;

use Exception;

final class ErrorException extends Exception
{
    /**
     * Creates a new Exception instance.
     *
     * @param  array{message: string|array<int, string>|null, type: ?string, code: string|int|null}  $contents
     */
    public function __construct(private readonly array $contents)
    {
        /** @var ?string $code */
        $code = $this->contents['code'];
        $contentsMessage = $contents['message'] ?? $code;
        $message = $contentsMessage ?? 'Unknown error';

        if (is_array($message)) {
            $message = implode(PHP_EOL, $message);
        }

        parent::__construct($message);
    }

    /**
     * Returns the error message.
     */
    public function getErrorMessage(): string
    {
        return $this->getMessage();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): ?string
    {
        return $this->contents['type'];
    }

    /**
     * Returns the error code.
     */
    public function getErrorCode(): string|int|null
    {
        return $this->contents['code'];
    }
}
