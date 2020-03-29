<?php
namespace File;
use Exception;
use Interfaces\FileInterface;

class File implements  FileInterface {
    /**
     * @var null
     */
    private $file = null;

    /**
     * @var null
     */
    private $filePath = null;

    /**
     * @param $filePath
     * @throws Exception
     */
    public function init($filePath) {
        if (!is_readable($filePath)) {
            $exceptionMessage = "Файл " . $filePath . " недоступен для чтения.";
            throw new Exception($exceptionMessage);
        }
        $this->filePath = $filePath;
    }

    /**
     * @return FileInterface
     */
    public function open() : FileInterface {
        $this->file = fopen($this->filePath, "r");
        return $this;
    }

    /**
     * @return string
     */
    public function fgets() {
        return fgets($this->file);
    }

    /**
     * @return FileInterface
     */
    public function close() : FileInterface {
        fclose($this->file);
        return $this;
    }
}