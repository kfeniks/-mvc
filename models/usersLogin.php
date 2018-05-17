<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 04.12.2017
 * Time: 23:33
 */

class UsersLogin extends Model {


        public function validate($data) {
            if ( !isset($data['email']) || !isset($data['password']) || !isset($data['code']) ) {

                return false;

            }

            session_start(); // стартуем сессию
            if ($_POST['code'] != $_SESSION['code']) {
                Session::setFlash('Капча введена неверно.');
                return false;
            }
            $email = $this->getByEmail($data['email']);
            $_password = Config::get('salt').$this->db->escape($data['password']);
            $password = md5($_password);

//            $_pass = 'apple';

            if ( $email || $password == md5($email['password']) || $email['is_active'] ) {

                Session::init();
                Session::set('loggedIn', true);
                Session::set('login', $email['email']);
                Session::set('role', $email['role']);
                Router::redirect('/admin/');

            }
        }

        public function getByEmail($email) {

            $login = $this->db->escape($email);

            $sql = "select * from users where email = '$login' limit 1";

            $result = $this->db->query($sql);

            if ( isset($result[0]) ) {
                return $result[0];
            }

            return false;

        }
}