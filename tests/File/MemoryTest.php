<?php

namespace FP_CLI\SqlTransform\Tests\File;

use FP_CLI\SqlTransform\File;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class MemoryTest extends TestCase
{
    /**
     * @covers \FP_CLI\SqlTransform\File\Memory::__construct
     * @covers \FP_CLI\SqlTransform\File\Memory::has_next_statement
     */
    public function testHasNextStatementReturnsFalseOnEmptyFile()
    {
        $file = new File\Memory( '' );
        self::assertFalse( $file->has_next_statement() );
    }

    /**
     * @covers \FP_CLI\SqlTransform\File\Memory::__construct
     * @covers \FP_CLI\SqlTransform\File\Memory::has_next_statement
     */
    public function testHasNextStatementReturnsTrueOnNonEmptyFile()
    {
        $sql = 'SELECT * FROM `fp_posts`;';
        $file = new File\Memory( $sql );
        self::assertTrue( $file->has_next_statement() );
    }

    /**
     * @covers \FP_CLI\SqlTransform\File\Memory::__construct
     * @covers \FP_CLI\SqlTransform\File\Memory::has_next_statement
     * @covers \FP_CLI\SqlTransform\File\Memory::get_next_statement
     */
    public function testHasNextStatementReturnsFalseWhenAtEndOfFile()
    {
        $sql = 'SELECT * FROM `fp_posts`; SELECT * FROM `fp_users`; ';
        $file = new File\Memory( $sql );
        self::assertTrue( $file->has_next_statement() );
        $file->get_next_statement();
        self::assertTrue( $file->has_next_statement() );
        $file->get_next_statement();
        self::assertFalse( $file->has_next_statement() );
    }

    /**
     * @covers \FP_CLI\SqlTransform\File\Memory::__construct
     * @covers \FP_CLI\SqlTransform\File\Memory::get_next_statement
     */
    public function testGetNextStatement()
    {
        $sql = 'SELECT * FROM `fp_posts`;';
        $file = new File\Memory( $sql );
        self::assertSame( $sql, $file->get_next_statement() );
    }
}