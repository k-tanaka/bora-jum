<?php
Class Plugin extends PluginAbstract
{
    public function preProcess()
    {
        $this->view->addJs('jquery-1.5.2.min.js');
        $this->view->addJs('hideshow.js');
        $this->view->addJs('jquery.tablesorter.min.js');
        $this->view->addJs('jquery.equalHeight.js');

        $this->view->site_title = '備品管理';

        $user_id = 1;
        $Users = $this->model('Users');
        $this->view->user_name = $Users->getUserName($user_id);

        $this->addBreadcrumb($this->view->site_title, '/');
    }

    public function addBreadcrumb($title = '', $url = '')
    {
        if (is_null($title) || $title === '') {
            return false;
        }

        $breadcrumbs = (is_null($this->view->breadcrumbs)) ? array() : $this->view->breadcrumbs;

        $breadcrumbs[] = array(
                'title' => $title,
                'url'   => $url,
                );
        $this->view->breadcrumbs = $breadcrumbs;

        return true;
    }

    public function setIndexBreadcrumb()
    {
        if (is_null($this->view->breadcrumbs)) {
            return false;
        }

        $breadcrumbs = $this->view->breadcrumbs;
        $breadcrumbs[count($breadcrumbs) - 1]['url'] = '';

        $this->view->breadcrumbs = $breadcrumbs;

        return true;
    }
}
?>
