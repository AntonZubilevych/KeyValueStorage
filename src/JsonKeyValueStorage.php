<?php

namespace App\Standart;


class JsonKeyValueStorage implements KeyValueStorageInterface
{
    private $fileName;

    public function __construct($file)
    {
        $this->fileName = $file;
    }

    public function set(string $key, $value): void
    {
        $array = $this->getContentFromJson();
        if (!isset($array[$key])) {
            $array[$key] = $value;
            $this->setContentToJson($array);
        }

    }


    public function get(string $key)
    {
        $array = $this->getContentFromJson();
        return $array[$key];
    }

    public function has(string $key): bool
    {
        $array = $this->getContentFromJson();
        return isset($array[$key]);
    }


    public function remove(string $key): void
    {
        $array = $this->getContentFromJson();
        unset($array[$key]);
        $this->setContentToJson($array);
    }


    public function clear(): void
    {
        $array = [];
        $this->setContentToJson($array);
    }

    private function getContentFromJson():?array
    {
        if(!(file_exists($this->fileName))){
            fopen($this->fileName, "w");
        }

        $string = file_get_contents($this->fileName);
        return json_decode($string,true);
    }

    private function setContentToJson($array):void
    {
        $json = json_encode($array);
        file_put_contents($this->fileName, $json,  LOCK_EX);
    }

    public function getFileName():string
    {
        return $this->fileName;
    }
}