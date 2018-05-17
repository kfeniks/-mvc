<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 04.12.2017
 * Time: 12:42
 */

class User extends Model {

    protected static $count_users;

//    public function getByEmail($email) {
//
//        $login = $this->db->escape($email);
//
//        $sql = "select * from users where email = $login limit 1";
//
//        $result = $this->db->query($sql);
//
//        if ( isset($result[0]) ) {
//            return $result[0];
//        }
//
//        return false;
//
//    }

    public function getList( $only_active = false ) {

        $sql = 'select * from users where 1';
        if ($only_active) {
            $sql .= 'and is_active = 1';
        }

        return $this->db->query($sql);
    }

    public function getById($id) {

        $id = (int)$id;
        $sql = 'select * from users where id = "'. $id .'" limit 1';
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }


    public function save($data, $id = null) {

        if ( !isset($data['fname']) || !isset($data['email']) || !isset($data['password']) || !isset($data['is_active'])  ) {

            return false;

        }

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $_password = Config::get('salt').$this->db->escape($data['password']);
        $password = md5($_password);
        $datetime = time(); // get the system date / time (UTC)
        $karma = '0';
        $is_active = isset($data['is_published']) ? 1 : 0;
        $status = isset($data['status']) ? 10 : 5;

        if (isset($data['karma'])) $karma = $this->db->escape($data['karma']);

        if ( !$id ) { // Add new record

            $sql = "
                insert into users
                  set fname = '$name',
                      email = '$email',
                      password = '$password',
                      karma = '$karma',
                      is_active = '$is_active',
                      status = '$status',
                      created_at = '$datetime'
            ";

        } else { // Update existing record

            $sql = "
                update into users
                  set fname = '$name',
                      email = '$email',
                      password = '$password',
                      is_active = '$is_active',
                      karma = '$karma',
                      status = '$status',
                      updated_at = '$datetime'
                  where id = '$id'
            ";

        }

        return $this->db->query($sql);
    }

    public function delete($id) {

        $id = (int)$id;
        $sql = "delete from users where id = '$id'";

        return $this->db->query($sql);

    }

    public function getCount() {

        $sql = 'select id from users';

        $count_users = $this->db->query($sql);

        self::$count_users = count($count_users);

        return !is_null(self::$count_users);

    }

    public static function count() {

        echo self::$count_users;
    }

}