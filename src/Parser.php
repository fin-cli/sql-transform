<?php

namespace FIN_CLI\SqlTransform;

use RuntimeException;
use FIN_CLI\SqlTransform\Sql;

interface Parser {

    /**
     * Parse a string of SQL statements into an array SQL statement objects.
     *
     * @param File $sql_file The string of SQL statements to parse.
     * @return array<Sql\Statement> The parsed SQL statements.
     */
    public function parse( File $sql_file ): array;

    /**
     * Parse a single SQL statement into a SQL statement object.
     *
     * @param string $sql The SQL statement to parse.
     * @return Sql\Statement The parsed SQL statement.
     */
    public function parse_statement( string $sql ): Sql\Statement;
}