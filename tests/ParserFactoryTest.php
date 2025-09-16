<?php

namespace FIN_CLI\SqlTransform\Tests;

use FIN_CLI\SqlTransform\Parser;
use FIN_CLI\SqlTransform\ParserFactory;
use \FIN_CLI\SqlTransform\Sql;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class ParserFactoryTest extends TestCase
{
    /**
     * @covers \FIN_CLI\SqlTransform\ParserFactory::create
     */
    public function testCreateMySQL()
    {
        $parser = ParserFactory::create( Sql\Dialect::MYSQL );
        self::assertInstanceOf( Parser\MySQL::class, $parser );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\ParserFactory::create
     */
    public function testCreateSQLite()
    {
        $parser = ParserFactory::create( Sql\Dialect::SQLITE );
        self::assertInstanceOf( Parser\SQLite::class, $parser );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\ParserFactory::create
     */
    public function testCreateThrowsExceptionOnUnsupportedDialect()
    {
        $this->expectException( \InvalidArgumentException::class );
        $this->expectExceptionMessage( 'Unsupported SQL dialect: unsupported' );
        ParserFactory::create( 'unsupported' );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\ParserFactory::create
     */
    public function testCreateThrowsExceptionOnUnimplementedDialect()
    {
        $this->expectException( \RuntimeException::class );
        $this->expectExceptionMessage( 'Parser not implemented yet for dialect: mariadb' );
        ParserFactory::create( 'mariadb' );
    }
}