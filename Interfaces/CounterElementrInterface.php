<?php
namespace Interfaces;

interface CounterElementrInterface {
    public function addValue($value);
    public function getResult() : array;
}