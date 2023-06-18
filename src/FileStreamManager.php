<?php

declare(strict_types=1);

namespace TinyGears;

use \Psr\Log\InvalidArgumentException;

class FileStreamManager implements IStreamManager
{
    public string $outputLogData = '';

    public function __construct(private string $path)
    {
    }

    public function save($level, string|\Stringable $message, array $context = [], ?string $loggerName=null): void
    {
        if (array_key_exists('exception', $context)) {
            $exception = $context['exception'];
            unset($context['exception']);
        }

        $level = (string) $level;
        $supportedLevels = ['emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'];

        if (!in_array($level, $supportedLevels)) {
            throw new InvalidArgumentException('Level not implemented', 0);
        }

        $datetime = date('Y-m-d H:i:s.u');
        $this->outputLogData .= '[' . $datetime . "]\t" . (!is_null($loggerName) ? $loggerName . '.' : '')  . strtoupper($level) . ":\t" . Logger::interpolate($message, $context) . PHP_EOL;
        if ($context <> []) {
            $this->outputLogData .= "\tContext: " . json_encode($context) . PHP_EOL;
        }
        if ($exception ?? null instanceof \Exception) {
            $this->outputLogData .= "\t" . $exception::class . '[' . $exception->getCode() . "]:\t" . $exception->getMessage() . ';' . PHP_EOL;
            $this->outputLogData .= "\tFile: " . $exception->getFile() . PHP_EOL;
            $this->outputLogData .= "\t" . $exception->getTraceAsString() . PHP_EOL;
        }

				$this->outputLogData .= PHP_EOL;

        file_put_contents($this->path, $this->outputLogData, FILE_APPEND);

        $this->outputLogData = '';
        
        return;
    }


}
