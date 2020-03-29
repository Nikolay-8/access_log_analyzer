<?php
namespace Interfaces;

interface FileInterface {
    public function init($ilePatch);
    public function open() : FileInterface;
    public function fgets();
    public function close() : FileInterface;
}