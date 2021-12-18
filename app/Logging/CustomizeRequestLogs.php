<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeRequestLogs
{
  public function __invoke($logger)
  {
    $dateFormat = "Y-m-d H:i:s";
    $output = "%datetime%||%message%\n";
    $formatter = new LineFormatter($output, $dateFormat);
        
    foreach ($logger->getHandlers() as $handler) {
      $handler->setFormatter($formatter);
    }
  }
}