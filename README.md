# artisan-bash-completion-plugin for Composer

This is an experimental hack to add [Symfony BASH auto complete](https://github.com/stecman/symfony-console-completion) to Composer via a plugin. It's a pretty slimy hack, but it works without editing Composer's code.

## Installation

1. Run `composer require baisam/artisan-bash-completion-plugin dev-master`
2. Add a completion class to App\Console\Kernel :

    ```php
    # The Artisan commands provided by your application.
    protected $commands = [
            \BaiSam\Component\Symfony\Console\BashCompletion\ArtisanCompletionCommand::class,
        ];
    ```

## Explanation

This hacky plugin injects an additional command into the Artisan application at runtime. When the plugin in this package is activated and the command line starts with `php artisan _completion`.
