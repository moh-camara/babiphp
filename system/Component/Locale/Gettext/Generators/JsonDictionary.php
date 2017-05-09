<?php

namespace BabiPHP\Component\Locale\Gettext\Generators;

use BabiPHP\Component\Locale\Gettext\Translations;

class JsonDictionary extends Generator implements GeneratorInterface
{
    /**
     * {@parentDoc}.
     */
    public static function toString(Translations $translations)
    {
        $array = PhpArray::toArray($translations);

        //for a simple json translation dictionary, one domain is supported
        $values = current($array);

        // remove meta / header data
        if (array_key_exists('', $values)) {
            unset($values['']);
        }

        //map to a simple json dictionary (no plurals)
        return json_encode(
            array_filter(
                array_map(function ($val) {
                    return isset($val[1]) ? $val[1] : null;
                }, $values)
            )
        );
    }
}
