<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.11.2017
 * Time: 18:49
 */

class DB {

    protected $connection;

    public function __construct( $host, $user, $password, $name ) {

        $this->connection = new mysqli( $host, $user, $password, $name );

        if ( mysqli_connect_error() ) {

            throw new Exception('Could ot connect to DB');

        }

        // That will reset collation_connection to utf8_general_ci
        // (the default collation for utf8):
        $this->connection->set_charset('utf8');
    }

    public function query($sql) {

        if ( !$this->connection ) {

            return false;

        }

        $result = $this->connection->query($sql);

        if ( mysqli_error($this->connection) ) {

            throw new Exception(mysqli_error($this->connection));

        }

        if ( is_bool($result) ) {

            return $result;
        }

        $data = array();
        while ( $row = mysqli_fetch_assoc($result) ) {

            $data[] = $row;
        }

        return $data;
    }

    public function escape($str) {

        return mysqli_escape_string($this->connection, $str);
    }
}