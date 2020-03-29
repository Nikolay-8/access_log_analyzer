<?php

class Analyzer_Handler {
    /**
     * @var Interfaces\CounterInterface
     */
    private $counter;

    /**
     * @var Interfaces\FileInterface
     */
    private $logFile = null;

    /**
     * @param Interfaces\CounterInterface $counter
     * @return $this
     */
    public function setCounter(Interfaces\CounterInterface $counter) {
        $this->counter = $counter;
        return $this;
    }

    /**
     * @param \Interfaces\FileInterface $logFile
     * @return $this
     */
    public function setLogFile(Interfaces\FileInterface $logFile) {
        $this->logFile = $logFile;
        return $this;
    }

    public function handle() {
        $logFile = $this->logFile()->open();
        $counter = $this->getCounter();
        $counter->init();

        while ($logLine = $logFile->fgets($logFile))
        {
            $counter->calculateLogLine($logLine);
        }
        $logFile->close();
    }

    /**
     * @return Interfaces\FileInterface
     */
    private function logFile() : Interfaces\FileInterface {
        return $this->logFile;
    }

    /**
     * @return Interfaces\CounterInterface
     */
    private function getCounter() {
        return $this->counter;
    }
}