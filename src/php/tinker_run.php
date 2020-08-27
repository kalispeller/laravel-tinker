<?php
require __DIR__.'/vendor/autoload.php';
$config=new \Psy\Configuration(['updateCheck'=>'never',]);
$config->setHistoryFile(defined('PHP_WINDOWS_VERSION_BUILD')?'null':'/dev/null');
$shell=new \Psy\Shell($config);
$output=new \Symfony\Component\Console\Output\BufferedOutput();
$shell->setOutput($output);
$autoloadClassMap='vendor/composer/autoload_classmap.php';
$loader = \Laravel\Tinker\ClassAliasAutoloader::register($shell,$autoloadClassMap);
$code=str_replace(['<?=','<?php','<?','?>'],'',$argv[1]);
$shell->execute($code);
$loader->unregister();
echo $output->fetch();
