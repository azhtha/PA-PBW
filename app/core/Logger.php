<?php
namespace App\Core;

class Logger {
    protected $logFile;

    public function __construct($logFile = null) {
        $this->logFile = $logFile ?: __DIR__ . '/../../storage/logs/app.log';
        $this->ensureLogDirectory();
    }

    protected function ensureLogDirectory() {
        $dir = dirname($this->logFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }

    public function info($message) {
        $this->log('INFO', $message);
    }

    public function error($message) {
        $this->log('ERROR', $message);
    }

    public function warning($message) {
        $this->log('WARNING', $message);
    }

    protected function log($level, $message) {
        $timestamp = date('Y-m-d H:i:s');
        $logEntry = "[{$timestamp}] {$level}: {$message}" . PHP_EOL;
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
}