<?php
/* Part of NextrasOrmTools */

namespace NextrasOrmTools;

class CommandLine
{
    /**
     * Write message to console
     *
     * @param string $msg
     */
    public static function write($msg)
    {
        printf($msg);
    }

    /**
     * Write message to console and write new line
     *
     * @param string $msg
     */
    public static function writeln($msg)
    {
        printf($msg . PHP_EOL);
    }

    /**
     * Get arguments from command line
     *
     * @return array
     */
    public static function getArguments()
    {
        $args = $_SERVER['argv'];
        unset($args[0]);

        return $args;
    }

}
