<?php
/**
 * システムTOP etc.
 *
 * @package     bora-jum
 * @author      Original Author <k-tanaka@netcombb.co.jp>
 * @copyright   Copyright (c) 2013 NetComBB
 */

class IndexController extends Controller
{
    public function index()
    {
        $this->view->breadcrumbs = array(
                array(
                    'title' => $this->view->site_title,
                    'url'   => ''
                    )
                );
    }
}
