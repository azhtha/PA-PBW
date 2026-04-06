<?php
namespace App\Core;

class App {
    private static $container = [];

    public static function bind($key, $value) {
        self::$container[$key] = $value;
    }

    public static function get($key) {
        return self::$container[$key] ?? null;
    }

    public static function make($class) {
        if (isset(self::$container[$class])) {
            return self::$container[$class];
        }

        // Simple auto-wiring for basic classes
        $reflection = new \ReflectionClass($class);
        $constructor = $reflection->getConstructor();

        if (!$constructor) {
            return new $class();
        }

        $params = $constructor->getParameters();
        $dependencies = [];

        foreach ($params as $param) {
            $type = $param->getType();
            if ($type && !$type->isBuiltin()) {
                $dependencyClass = $type->getName();
                $dependencies[] = self::make($dependencyClass);
            } else {
                $dependencies[] = null; // For now, assume no scalar dependencies
            }
        }

        return $reflection->newInstanceArgs($dependencies);
    }
}