<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.11.2017
 * Time: 12:34
 */

class Message extends Model {

    protected static $count_message;

    public function getList() {

        $sql = 'select * from messages';

        return $this->db->query($sql);
    }

    public function getById($id) {

        $id = (int)$id;
        $sql = 'select * from messages where messages_id = "'. $id .'" limit 1';
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function save($data, $id = null) {

        if ( !isset($data['name']) || !isset($data['email']) || !isset($data['message']) || !isset($data['code']) ) {

            return false;

        }

        session_start(); // стартуем сессию
        if ($_POST['code'] != $_SESSION['code']) {
            Session::setFlash('Капча введена неверно.');
            return false;
        }

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if ( !$id ) { // Add new record

            $sql = "
                insert into messages
                  set messages_name = '$name',
                      messages_email = '$email',
                      messages_text = '$message'
            ";

        } else { // Update existing record

            $sql = "
                update messages
                  set messages_name = '$name',
                      messages_email = '$email',
                      messages_text = '$message'
                  where messages_id = '$id'
            ";

        }

        return $this->db->query($sql);
    }

    public function delete($id) {

        $id = (int)$id;
        $sql = "delete from messages where messages_id = '$id'";

        return $this->db->query($sql);

    }

    public function getCount() {

        $sql = 'select messages_id from messages';

        $count_message = $this->db->query($sql);

        self::$count_message = count($count_message);


//        self::$count_message = count($count_message);

        return !is_null(self::$count_message);

    }

    public static function count() {

        echo self::$count_message;
    }

}