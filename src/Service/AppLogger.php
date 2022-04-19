<?php

namespace App\Service;
use think\facade\Log;

class AppLogger
{
    const TYPE_LOG4PHP = 'log4php';

    private $logger;

    public function __construct($type = self::TYPE_LOG4PHP)
    {
        $logger = [
            self::TYPE_LOG4PHP => new Log4AppLogger(),
            'think-log' => new ThinklogAppLogger()
        ];

        if (!isset($logger[$type]))
        {
            throw new \Exception('Not support type of logger');
        }
        $this->logger = $logger[$type];
    }

    public function info($message = '')
    {
        $this->logger->info($message);
    }

    public function debug($message = '')
    {
        $this->logger->debug($message);
    }

    public function error($message = '')
    {
        $this->logger->error($message);
    }
}

interface iAppLogger
{
    public function info(string $message);
    public function debug(string $message);
    public function error(string $message);
}

class Log4AppLogger implements iAppLogger
{
    private $logger;

    public function __construct()
    {
        $this->logger = \Logger::getLogger("Log");
    }

    public function info(string $message)
    {
        $this->logger->info($message);
    }

    public function debug(string $message)
    {
        $this->logger->debug($message);
    }

    public function error(string $message)
    {
        $this->logger->error($message);
    }
}

class ThinklogAppLogger implements iAppLogger
{
    public function __construct()
    {
        Log::init([
            'default'	=>	'file',
            'channels'	=>	[
                'file'	=>	[
                    'type'	=>	'file',
                    'path'	=>	'./logs/',
                ],
            ],
        ]);
    }

    public function __destruct()
    {
        Log::close();
    }

    public function info(string $message)
    {
        Log::write(strtoupper($message), 'info');
    }

    public function debug(string $message)
    {
        Log::write(strtoupper($message), 'debug');
    }

    public function error(string $message)
    {
        Log::write(strtoupper($message), 'error');
    }
}