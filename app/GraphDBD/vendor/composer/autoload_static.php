<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1c4e562d1e16d8f72bbf0614841d3a27
{
    public static $prefixesPsr0 = array (
        'E' => 
        array (
            'Everyman\\Neo4j' => 
            array (
                0 => __DIR__ . '/..' . '/everyman/neo4jphp/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit1c4e562d1e16d8f72bbf0614841d3a27::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
