<?php

namespace KanekiYuto\Handy\Cascade\Make;

/**
 * 存根模板
 *
 * @author KanekiYuto
 */
trait Template
{

    /**
     * 制表
     *
     * @param  string  $string
     * @param  int     $quantity
     * @param  bool    $first
     *
     * @return string
     */
    protected final function tab(string $string, int $quantity, bool $first = true): string
    {
        $string = explode("\n", $string);
        $tabString = [];

        foreach ($string as $key => $value) {
            if ($key !== 0 || $first === false) {
                $value = str_repeat("\t", $quantity) . $value;
            }

            $tabString[] = $value;
        }

        return implode("\n", $tabString);
    }

}
