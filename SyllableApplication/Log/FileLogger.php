<?php

namespace Log;

class FileLogger implements LoggerInterface
{

    public static function emergency($message, array $context = array())
    {
        FileLogger::log(LogLevel::EMERGENCY, $message, $context);
    }

    public static function alert($message, array $context = array())
    {
        FileLogger::log(LogLevel::ALERT, $message, $context);
    }

    public static function critical($message, array $context = array())
    {
        FileLogger::log(LogLevel::CRITICAL, $message, $context);
    }

    public static function error($message, array $context = array())
    {
        FileLogger::log(LogLevel::ERROR, $message, $context);
    }

    public static function warning($message, array $context = array())
    {
        FileLogger::log(LogLevel::WARNING, $message, $context);
    }

    public static function notice($message, array $context = array())
    {
        FileLogger::log(LogLevel::NOTICE, $message, $context);
    }

    public static function info($message, array $context = array())
    {
        FileLogger::log(LogLevel::INFO, $message, $context);
    }

    public static function debug($message, array $context = array())
    {
        FileLogger::log(LogLevel::DEBUG, $message, $context);
    }

    public static function log($level, $message)
    {
        $logFile = __DIR__ . '\\' . 'SystemLog.txt'; // i conf
        $current = sprintf(
            "[%s] [LEVEL:%s] %s\n",
            date('Y M d G:i:s'), // i conf
            strtoupper($level),
            $message
        );
        file_put_contents($logFile, $current, FILE_APPEND);
    }
}

