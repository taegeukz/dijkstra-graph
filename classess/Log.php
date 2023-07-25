<?php

class Log
{
    private array $content = [];

    public function getContent(): string
    {
        return implode(PHP_EOL, $this->content) . PHP_EOL;
    }

    public function addContent(string $text): void
    {
        $this->content[] = $text;
    }

    public function saveToFile($filename): void
    {
        if(! empty($this->content)) {
            $file = fopen($filename, 'w');
            fwrite($file, implode(PHP_EOL, $this->content));
            fclose($file);
        }
    }
}