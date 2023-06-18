<?php

declare(strict_types=1);

namespace TinyGears;

use Stringable;
use Psr\Log\{
    LoggerInterface,
    InvalidArgumentException,
    LoggerTrait
};

/**  
 * @author Ronny John<me@ronnyjohnti.dev>
 * @author Ryan Lima<contato@ryanlima.dev>
 */

final class Logger implements LoggerInterface
{
    use LoggerTrait;

    public function __construct(
        private IStreamManager $streamManager,
        private ?string $name = null
    ) {
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string|\Stringable $message
     * @param array<mixed> $context
     * @param array<string> $options
     * 
     * @return void
     *
     * @throws \Psr\Log\InvalidArgumentException
     */
    public function log($level, string|\Stringable $message, array $context = []): void
    {

        if ($this->streamManager instanceof IStreamManager) {
            $this->streamManager->save($level, $message, $context, $this->name);
        }
    }

    /**
     * Used to replace the interpolations on the message with the value given in the $context
     * @param string|\Stringable $message
     * @param array<mixed> $context 
     */
    public static function interpolate(string|\Stringable $message, array $context = []): string
    {

        $replace = [];
        array_walk(
            $context,
            function (mixed $value, string $key) use (&$replace): void {
                if (!is_array($value) && (!is_object($value) || $value instanceof \Stringable)) {
                    return;
                }
                $replace['{' . $key . '}'] = $value;
            }
        );

        return strtr((string) $message, $replace);
    }

}
