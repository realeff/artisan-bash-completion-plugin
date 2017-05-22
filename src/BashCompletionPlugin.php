<?php

namespace Ninebost\Component\Symfony\Console\BashCompletion;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\ArrayInput;

class BashCompletionPlugin implements PluginInterface
{
    /**
     * @var \Symfony\Component\Console\Input\ArgvInput
     */
    protected $input;

    public function activate(Composer $composer, IOInterface $io)
    {
        /** @var Application $application */
        global $argv;
        global $application;
        global $__bashCompletionInjected;

        // Inject completion command when the command line is `composer depends _artisan`
        if ($argv[1] == 'depends' && $argv[2] == '_artisan' && !$__bashCompletionInjected) {
            $__bashCompletionInjected = true;

            // Drop the original command name argument so that "_artisan" takes its place
            $argv[0] = 'php';
            $argv[1] = 'artisan';
            $input = new ArgvInput($argv);

            $application->add(new ArtisanCompletionCommand());
            $application->run($input);
            die();
        }
    }
}
