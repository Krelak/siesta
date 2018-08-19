<?php
namespace siesta\domain\exception;

use Throwable;

/**
 * Class RecordException
 * @package siesta\domain\exception
 */
class RecordException extends \Exception
{
    private const MESSAGE = 'Error recording data';

    /**
     * WrongInputException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        $message = sprintf(self::MESSAGE, $message);
        parent::__construct($message, $code, $previous);
    }
}