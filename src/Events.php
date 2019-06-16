<?php

namespace Sinevia;

class Events
{
    public static $events = null;

    public static function trigger($event, $args = array(), $callback = null)
    {
        if (is_null(self::$events)) {
            return;
        }

        foreach (self::$events as $e) {
            if ($e[0] = $event) {
                $result = (new $e[1])($args);
                if (is_callable($callback)) {
                    $callback($result);
                }
            }
        }
    }

    public static function add($event, callable $func, $priority = 0)
    {
        if (is_null(self::$events)) {
            self::$events = new \SplPriorityQueue();
        }

        self::$events->insert([$event, $func], $priority);
    }
}
