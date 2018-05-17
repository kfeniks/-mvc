<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.11.2017
 * Time: 14:17
 */

class ContactController extends Controller {

    public function __construct( $data = array() ) {

        parent::__construct($data);
        $this->model = new Message();


        $this->page = new Page();
        $this->users = new User();

        $this->model->getCount();
        $this->users->getCount();
        $this->page->getCount();

    }

    public function index() {

        if ( $_POST ) {

        if ( $this->model->save($_POST) ) {

                Session::setFlash('Thank you! Your message was sent successfully.');

            }
        }

    }

    public function admin_index() {

        $this->data['messages'] = $this->model->getList();

    }

    public function admin_view() {

        if ( isset($this->params[0]) ) {

            $this->data['message'] = $this->model->getById($this->params[0]);

        } else {
            Session::setFlash("Wrong Message Id.");
            Router::redirect("/admin/contact/");
        }

    }

    public function admin_delete(){
        if (isset($this->params[0])) {

            $result = $this->model->delete($this->params[0]);

            if ($result) {
                Session::setFlash('Message was deleted.');
            } else {
                Session::setFlash('Error. Message was not deleted.');
            }

        }
        Router::redirect('/admin/contact/');
    }
}