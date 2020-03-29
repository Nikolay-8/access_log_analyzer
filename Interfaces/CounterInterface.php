<?php
namespace Interfaces;

interface CounterInterface {
    public function init();
    public function calculateLogLine($logLine);
    public function getResult() : array;
}