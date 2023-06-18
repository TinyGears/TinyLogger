<?php

declare(strict_types=1);

namespace TinyGears;

interface IStreamManager
{
	public function save($level, string|\Stringable $message, array $context = [], ?string $loggerName = null): void;
}
