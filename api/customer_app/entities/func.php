<?php
class news_functions
{
    private $connection;
    function __construct()
    {
        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "mysql";
        $dbname = "newsapp";

        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

        if (!$this->connection) {
            die("Databse connection error!!!");
        }
    }


    function fn_get_news($params = [])
    {
        $default_params = array(
            'page' => 1,
            'items_per_page' => $items_per_page
        );
        $params = array_merge($default_params, $params);
        $condition = $limit = $join = '';
        
        if (!empty($params['CategoryId'])) {
            $condition .= " AND tblposts.CategoryId = '".$params['CategoryId']."'";
        }
        if (!empty($params['q'])) {
            $condition .= " AND (tblposts.PostTitle LIKE '%".$params['q']."%' OR tblposts.PostDetails LIKE '%".$params['q']."%')";
        }
        if(!empty($params['pagination'])){
            $params['items_per_page'] = $perPage = !empty($params['items_per_page'])?$params['items_per_page']:10;
            $page = (!empty($params['page'])) ? (int)$params['page'] : 1;
            $startAt = $perPage * ($page - 1);
            $query = "SELECT COUNT(*) as total FROM tblposts where 1 $condition";
            $r = mysqli_fetch_assoc(mysqli_query($this->connection,$query));
            $params['totalPages'] = ceil($r['total'] / $perPage);
            $params['page'] = $page;
            $condition .= " ORDER BY 'PostingDate' LIMIT $startAt, $perPage";
        }
        $query = "SELECT * FROM tblposts where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $news = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return [!empty($news) ? $news : [],!empty($params) ? $params : []];
    }
    function fn_get_news_data($id)
    {
        if(empty($id)){
            return false;
        }
        $condition = $limit = $join = '';
        if (!empty($id)) {
            $condition .= " AND tblposts.id = '".$id."'";
        }
        $query = "SELECT * FROM tblposts where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $news = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return !empty($news) ? reset($news) : [];
    }
}
