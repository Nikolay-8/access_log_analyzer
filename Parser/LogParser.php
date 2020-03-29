<?php
namespace Parser;
use Interfaces\ParserInterface;

class LogParser implements ParserInterface {
    /**
     * @var array
     */
    private $params = array();

    /**
     * @param array $params
     */
    public function setParams(array $params) {
        $this->params = $params;
    }

    /**
     * @param string $logLine
     * @return array
     */
    public function parseLogLine($logLine) {
        $params = $this->params();
        $result = array();
        foreach ($params as $key => $regularExpression) {
            if (preg_match ($regularExpression, $logLine, $resultItem)) {
                $result[$key] = $resultItem[0];
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    private function params() {
        return $this->params;
    }
}