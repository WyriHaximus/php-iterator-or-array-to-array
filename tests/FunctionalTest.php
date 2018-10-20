<?php declare(strict_types=1);

namespace WyriHaximus\Tests;

use ApiClients\Tools\TestUtilities\TestCase;
use function WyriHaximus\iteratorOrArrayToArray;

final class FunctionalTest extends TestCase
{
    public function provideIterables(): iterable
    {
        yield [
            ['a'],
            ['a'],
        ];

        yield [
            new \ArrayIterator(['a']),
            ['a'],
        ];

        yield [
            new \CallbackFilterIterator(
                new \ArrayIterator(['a', 0, '0', 'd', 'b', 'c']),
                function ($item) {
                    return $item === 'a';
                }
            ),
            ['a'],
        ];

        yield [
            (function (): iterable {
                yield 'a';
            })(),
            ['a'],
        ];
    }

    /**
     * @dataProvider provideIterables
     */
    public function testTestIterable(iterable $iterable, array $array): void
    {
        self::assertSame($array, iteratorOrArrayToArray($iterable));
    }
}
