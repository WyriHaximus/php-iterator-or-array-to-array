<?php declare(strict_types=1);

namespace WyriHaximus;

function iteratorOrArrayToArray(iterable $iterable): array
{
    if (is_array($iterable)) {
        return $iterable;
    }

    return iterator_to_array($iterable);
}
