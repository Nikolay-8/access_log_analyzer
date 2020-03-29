<?php
namespace Interfaces;

interface ParserInterface {
    public function setParams(array $params);
    public function parseLogLine($logLine);
}