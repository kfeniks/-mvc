<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.11.2017
 * Time: 19:11
 */

class Model {

    protected $db;

    public function __construct() {

        $this->db = App::$db;
    }
}