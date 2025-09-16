<?php

namespace FIN_CLI\SqlTransform\Tests\Sql\Statement;

use FIN_CLI\SqlTransform\Sql;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class GenericTest extends TestCase
{
    /**
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::__construct
     */
    public function testInstantiation() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fin_posts`;' );
        self::assertInstanceOf( Sql\Statement::class, $statement );
        self::assertInstanceOf( Sql\Statement\Generic::class, $statement );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::__construct
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::extract_keyword
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::get_keyword
     */
    public function testGetKeyword() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fin_posts`;' );
        self::assertEquals( 'SELECT', $statement->get_keyword() );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::__construct
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::extract_qualifiers
     * @covers \FIN_CLI\SqlTransform\Sql\Statement\Generic::get_qualifiers
     */
    public function testGetQualifiers() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fin_posts`;' );
        self::assertEquals( [ '*', 'FROM', '`fin_posts`' ], $statement->get_qualifiers() );
    }
}