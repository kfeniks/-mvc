<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 04.12.2017
 * Time: 23:38
 */

class CaptchaController extends Controller {
    public function __construct( $data = array() )
    {
        parent::__construct($data);
        $this->model = new CaptchaCode();

    }


    public function index() {
        $this->model->getCaptcha();
    }
}