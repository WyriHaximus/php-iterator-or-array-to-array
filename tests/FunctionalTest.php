<?php

declare(strict_types=1);

namespace WyriHaximus\Tests;

use ArrayIterator;
use CallbackFilterIterator;
use WyriHaximus\TestUtilities\TestCase;

use function WyriHaximus\iteratorOrArrayToArray;

/**
 * @internal
 */
final class FunctionalTest extends TestCase
{
    /**
     * @return iterable<array<array<string>|iterable<string>>>
     */
    public function provideIterables(): iterable
    {
        yield [
            ['a'],
            ['a'],
        ];

        yield [
            new ArrayIterator(['a']),
            ['a'],
        ];

        yield [
            new CallbackFilterIterator(
                new ArrayIterator(['a', 0, '0', 'd', 'b', 'c']),
                static function ($item): bool {
                    return $item === 'a';
                }
            ),
            ['a'],
        ];

        yield [
            (static function (): iterable {
                yield 'a';
            })(),
            ['a'],
        ];
    }

    /**
     * @param iterable<string> $iterable
     * @param array<string>    $array
     *
     * @dataProvider provideIterables
     */
    public function testTestIterable(iterable $iterable, array $array): void
    {
        self::assertSame($array, iteratorOrArrayToArray($iterable));
    }
}
