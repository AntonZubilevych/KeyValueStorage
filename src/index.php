<?php

require __DIR__ . '/../vendor/autoload.php';






$yaml = new \App\Standart\YAMLKeyValueStorage('fffq.yaml');

$yaml->set('ff',10);

echo $yaml->get('ff').PHP_EOL;
var_dump($yaml);




