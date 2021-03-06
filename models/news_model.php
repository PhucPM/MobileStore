<?php

/**
 * Create date: 04-08-2013
 * @author Lại Đạo 
 * Category
 */
class news_model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllNews() {
        $news = $this->selectAllTable('news.*,category.id as idcate, name', ' news join category on news.category_id = category.id', MYSQLI_ASSOC);
        return $news;
    }

    public function getStatus() {
        return $status = $this->selectStatus();
    }

    public function getCategoryNews() {
        return $cate = $this->selectAll('id, name', 'category', null, null, MYSQLI_ASSOC);
    }

    public function getEdit($id) {
        $options = array('where' => 'id =' . $id);
        return $new = $this->selectOneRow('*', 'news', $options, null, MYSQLI_ASSOC);
    }

    public function saveAdd($data) {
        return $this->insert($data, 'news');
    }

    public function saveEdit($data, $id) {
        return $this->update($data, 'news', 'id =' . $id);
    }

    public function deleteNew($id) {
        return $this->delete('news', 'id =' . $id);
    }

    //News Home
    function getContNews() {
        $options = array('where' => 'status = 1');
        return $this->selectCount('id', 'count', 'news', $options, null, 2);
    }

    function getAllNewsLimit($start, $display) {
        $options = array('where' => 'status = 1', 'limit' => "$start,$display");
        return $this->selectAll('news.id, title, description, fullname, name, category_id, views', 'news join category on news.category_id = category.id join accounts on accounts.id = news.account_id', $options, null, MYSQLI_ASSOC);
    }

    //Category
    function getCountCategory($id) {
        $options = array('where' => "category_id = $id");
        return $this->selectCount('id', 'count', 'news', $options, null, 2);
    }

    function getAllNewsCategoryLimit($id, $start, $display) {
        $options = array('where' => "status = 1 AND category_id = $id", 'limit' => "$start,$display");
        return $this->selectAll('news.id, title, description, fullname, name, category_id, views', 'news join category on news.category_id = category.id join accounts on accounts.id = news.account_id', $options, null, MYSQLI_ASSOC);
    }

    //Update views
    function updateViews($data, $id) {
        return $this->update($data, 'news', "id = {$id}");
    }

    //View Most
    function viewMost() {
        $options = array(
            'order' => ' views DESC',
            'limit' => '0, 10'
        );
        return $this->selectAll('id, title', 'news', $options, null, 1);
    }

}

?>
