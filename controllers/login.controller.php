<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 04.12.2017
 * Time: 23:53
 */

class LoginController extends Controller {


    public function __construct( $data = array() ) {

        parent::__construct($data);
        $this->model = new UsersLogin();

        Session::init();
        $logged = Session::get('loggedIn');
        $role = Session::get('role');
        if($logged == true && $role == 'admin') {
//            Session::destroy();
            Router::redirect('/admin/');
//            exit();
        }

    }

    public function index() {
        if ( $_POST ) {

            if ( $this->model->validate($_POST) ) {

                Session::setFlash("Спасибо, Вы вошли как". $_POST['email']);

            }
        }

        $this->data['role'] = Session::get('role');

    }

    public function logout() {
        Session::destroy();
        Router::redirect('/login/');
//        exit();
    }

    public function admin_index() {

    }
}