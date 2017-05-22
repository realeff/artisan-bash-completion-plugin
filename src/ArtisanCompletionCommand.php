<?php

namespace Ninebost\Component\Symfony\Console\BashCompletion;

use Stecman\Component\Symfony\Console\BashCompletion\CompletionCommand;
use Stecman\Component\Symfony\Console\BashCompletion\Completion;

class ArtisanCompletionCommand extends CompletionCommand
{
    
    protected function runCompletion()
    {
        $context = $this->handler->getContext();
        $words = $context->getWords();

        // Complete for `help` command's `command` argument
        $application = $this->getApplication();
        $this->handler->addHandler(
            new Completion(
                'help',
                'command_name',
                Completion::TYPE_ARGUMENT,
                function() use ($application) {
                    $names = array_keys($application->all());

                    if ($key = array_search('_completion', $names)) {
                        unset($names[$key]);
                    }

                    return $names;
                }
            )
        );

        return $this->handler->runCompletion();
    }

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		$possibleCommands = $this->runCompletion();
		echo implode(' ', $possibleCommands);
	}
}
