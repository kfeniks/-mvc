<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 07.12.2017
 * Time: 23:04
 */

class UsersController extends Controller {

    public function __construct($data = array())
    {
        parent::__construct($data);
        $this->model = new User();
        $this->pages = new Page();
        $this->messages = new Message();

        $this->model->getCount();
        $this->messages->getCount();
        $this->pages->getCount();
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

    public function admin_index(){
        $this->data['users'] = $this->model->getList();
    }

    public function admin_add() {
        if ($_POST) {
            $result = $this->model->save($_POST);
            if ( $result ) {
                Session::setFlash('User was saved.');
            } else {
                Session::setFlash('Error. User is not saved.');
            }
            Router::redirect('/admin/users/');
        }
    }

    public function admin_edit() {

        if ($_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $result = $this->model->save($_POST, $id);
            if ( $result ) {
                Session::setFlash('User was saved.');
            } else {
                Session::setFlash('Error. User is not saved.');
            }
            Router::redirect('/admin/users/');
        }

        if ( isset($this->params[0]) ) {

            $this->data['user'] = $this->model->getById($this->params[0]);

        } else {
            Session::setFlash("Wrong User Id.");
            Router::redirect("/admin/users/");
        }

    }

    public function admin_delete(){
        if (isset($this->params[0])) {

            $result = $this->model->delete($this->params[0]);

            if ($result) {
                Session::setFlash('Page was deleted.');
            } else {
                Session::setFlash('Error. Page was not deleted.');
            }

        }
        Router::redirect('/admin/pages/');
    }
}