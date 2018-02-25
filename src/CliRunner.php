<?php
/* Part of NextrasOrmTools */

namespace NextrasOrmTools;

class CliRunner
{
    /**
     * Run app
     */
    public function run()
    {
        if (isset(CommandLine::getArguments()[1])) {
            switch (CommandLine::getArguments()[1]) {
                case 'generate:model':
                    CommandLine::writeln(Commands::getTitle());

                    if (CommandLine::getArguments()[3] == '-n') {
                        $namespace = CommandLine::getArguments()[4];
                        Commands::generateCommand(CommandLine::getArguments()[2],$namespace);
                    } else {
                        Commands::generateCommand(CommandLine::getArguments()[2],'App\\Model\\Orm');
                    }

                    break;
                default:
                    CommandLine::writeln(Commands::getTitle());
                    CommandLine::writeln('Command not found!');
                    break;
            }
        } else {
            CommandLine::writeln(Commands::getTitle());
            CommandLine::writeln(Commands::getOptions());
        }
    }
}
