<?php

namespace FP_CLI\SqlTransform\Tests\Sql\Statement;

use FP_CLI\SqlTransform\Sql;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class GenericTest extends TestCase
{
    /**
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::__construct
     */
    public function testInstantiation() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fp_posts`;' );
        self::assertInstanceOf( Sql\Statement::class, $statement );
        self::assertInstanceOf( Sql\Statement\Generic::class, $statement );
    }

    /**
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::__construct
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::extract_keyword
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::get_keyword
     */
    public function testGetKeyword() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fp_posts`;' );
        self::assertEquals( 'SELECT', $statement->get_keyword() );
    }

    /**
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::__construct
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::extract_qualifiers
     * @covers \FP_CLI\SqlTransform\Sql\Statement\Generic::get_qualifiers
     */
    public function testGetQualifiers() {
        $statement = new Sql\Statement\Generic( 'SELECT * FROM `fp_posts`;' );
        self::assertEquals( [ '*', 'FROM', '`fp_posts`' ], $statement->get_qualifiers() );
    }
}