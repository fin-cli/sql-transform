<?php

namespace FIN_CLI\SqlTransform\Tests;

use FIN_CLI\SqlTransform\Renderer;
use FIN_CLI\SqlTransform\RendererFactory;
use \FIN_CLI\SqlTransform\Sql;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class RendererFactoryTest extends TestCase
{
    /**
     * @covers \FIN_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateMySQL()
    {
        $parser = RendererFactory::create( Sql\Dialect::MYSQL );
        self::assertInstanceOf( Renderer\MySQL::class, $parser );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateSQLite()
    {
        $parser = RendererFactory::create( Sql\Dialect::SQLITE );
        self::assertInstanceOf( Renderer\SQLite::class, $parser );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateThrowsExceptionOnUnsupportedDialect()
    {
        $this->expectException( \InvalidArgumentException::class );
        $this->expectExceptionMessage( 'Unsupported SQL dialect: unsupported' );
        RendererFactory::create( 'unsupported' );
    }

    /**
     * @covers \FIN_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateThrowsExceptionOnUnimplementedDialect()
    {
        $this->expectException( \RuntimeException::class );
        $this->expectExceptionMessage( 'Renderer not implemented yet for dialect: mariadb' );
        RendererFactory::create( 'mariadb' );
    }
}