<?php

namespace FP_CLI\SqlTransform\Tests;

use FP_CLI\SqlTransform\Renderer;
use FP_CLI\SqlTransform\RendererFactory;
use \FP_CLI\SqlTransform\Sql;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class RendererFactoryTest extends TestCase
{
    /**
     * @covers \FP_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateMySQL()
    {
        $parser = RendererFactory::create( Sql\Dialect::MYSQL );
        self::assertInstanceOf( Renderer\MySQL::class, $parser );
    }

    /**
     * @covers \FP_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateSQLite()
    {
        $parser = RendererFactory::create( Sql\Dialect::SQLITE );
        self::assertInstanceOf( Renderer\SQLite::class, $parser );
    }

    /**
     * @covers \FP_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateThrowsExceptionOnUnsupportedDialect()
    {
        $this->expectException( \InvalidArgumentException::class );
        $this->expectExceptionMessage( 'Unsupported SQL dialect: unsupported' );
        RendererFactory::create( 'unsupported' );
    }

    /**
     * @covers \FP_CLI\SqlTransform\RendererFactory::create
     */
    public function testCreateThrowsExceptionOnUnimplementedDialect()
    {
        $this->expectException( \RuntimeException::class );
        $this->expectExceptionMessage( 'Renderer not implemented yet for dialect: mariadb' );
        RendererFactory::create( 'mariadb' );
    }
}