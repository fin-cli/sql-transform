<?php

namespace FIN_CLI\SqlTransform\Tests\File;

use FIN_CLI\SqlTransform\File;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class MemoryTest extends TestCase
{
    /**
     * @covers \FIN_CLI\SqlTransform\File\Memory::__construct
     * @covers \FIN_CLI\SqlTransform\File\Memory::has_next_statement
     */
    public function testHasNextStatementReturnsFalseOnEmptyFile()
    {
        $file = new File\Memory( '' );
        self::assertFalse( $file->has_next_statement() );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\File\Memory::__construct
     * @covers \FIN_CLI\SqlTransform\File\Memory::has_next_statement
     */
    public function testHasNextStatementReturnsTrueOnNonEmptyFile()
    {
        $sql = 'SELECT * FROM `fin_posts`;';
        $file = new File\Memory( $sql );
        self::assertTrue( $file->has_next_statement() );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\File\Memory::__construct
     * @covers \FIN_CLI\SqlTransform\File\Memory::has_next_statement
     * @covers \FIN_CLI\SqlTransform\File\Memory::get_next_statement
     */
    public function testHasNextStatementReturnsFalseWhenAtEndOfFile()
    {
        $sql = 'SELECT * FROM `fin_posts`; SELECT * FROM `fin_users`; ';
        $file = new File\Memory( $sql );
        self::assertTrue( $file->has_next_statement() );
        $file->get_next_statement();
        self::assertTrue( $file->has_next_statement() );
        $file->get_next_statement();
        self::assertFalse( $file->has_next_statement() );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\File\Memory::__construct
     * @covers \FIN_CLI\SqlTransform\File\Memory::get_next_statement
     */
    public function testGetNextStatement()
    {
        $sql = 'SELECT * FROM `fin_posts`;';
        $file = new File\Memory( $sql );
        self::assertSame( $sql, $file->get_next_statement() );
    }
}