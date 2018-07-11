<?php 
namespace Log;

use SplFileObject;

class FileLogger implements LoggerInterface
{
    // private $file;

    // public static function logOpen()
    // {
    //     $file = new SplFileObject;
    // }
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
    public static function log($level, $message, array $context = array())
    {
        $LogFile = __DIR__.'\\'.'SystemLog.txt';
        $current = file_get_contents($LogFile);
        $current .= "\n[" . date('Y M d') . "]" . $level . ": $message\n";
        file_put_contents($LogFile, $current);
    }
}

