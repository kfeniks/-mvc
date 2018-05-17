<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 06.12.2017
 * Time: 13:14
 */

class HomeController extends Controller {

    public function __construct( $data = array() )
    {
        parent::__construct($data);
        $this->model = new Page();
        $this->messages = new Message();
        $this->users = new User();

//        Session::init();
//        $logged = Session::get('loggedIn');
//        if($logged == false) {
//            Session::destroy();
//            Router::redirect('/login/');
////            exit();
//        }

        $this->model->getCount();
        $this->messages->getCount();
        $this->users->getCount();
    }

    public function index() {
//        echo 'Here will be a pages list';
//        $this->data['test_content'] = 'Here will be a pages list';

        $this->data['pages'] = $this->model->getList();
    }

    public function view() {
        $params = App::getRouter()->getParams();

        if ( isset($params[0]) ) {
            $alias = strtolower($params[0]);
//            $this->data['content'] = 'Here will be a page with '.$alias.' alias';
            $this->data['page'] = $this->model->getByAlias($alias);
        }
    }

    public function admin_index() {
        $this->data['pages'] = $this->model->getList();
    }

}