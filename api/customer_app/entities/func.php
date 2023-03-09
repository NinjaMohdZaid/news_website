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


    function fn_get_news($params = [],$items_per_page = 0,$lang_code = 'en')
    {
        $default_params = array(
            'page' => 1,
            'items_per_page' => $items_per_page
        );
        $params = array_merge($default_params, $params);
        $condition = $limit = $join = '';
        $fields = "tblposts.*,tblpost_descriptions.PostTitle,tblpost_descriptions.PostDetails";
        $condition .= " AND tblpost_descriptions.lang_code = '$lang_code'";
        $condition .= " AND tblposts.is_deleted != 'Y'";
        $join .= " LEFT JOIN tblpost_descriptions ON tblpost_descriptions.id = tblposts.id";
        if (!empty($params['CategoryId'])) {
            $condition .= " AND tblposts.CategoryId = '".$params['CategoryId']."'";
        }
        if (!empty($params['q'])) {
            $condition .= " AND (tblpost_descriptions.PostTitle LIKE '%".$params['q']."%' OR tblpost_descriptions.PostDetails LIKE '%".$params['q']."%')";
        }
        if(!empty($params['pagination'])){
            $params['items_per_page'] = $perPage = !empty($params['items_per_page'])?$params['items_per_page']:10;
            $page = (!empty($params['page'])) ? (int)$params['page'] : 1;
            $startAt = $perPage * ($page - 1);
            $query = "SELECT COUNT(*) as total FROM tblposts $join where 1 $condition";
            $r = mysqli_fetch_assoc(mysqli_query($this->connection,$query));
            $params['totalPages'] = ceil($r['total'] / $perPage);
            $params['page'] = $page;
            $condition .= " ORDER BY 'timestamp' LIMIT $startAt, $perPage";
        }
        $query = "SELECT $fields FROM tblposts $join where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $news = mysqli_fetch_all($run, MYSQLI_ASSOC);
        if(!empty($news)){
            foreach ($news as $key => &$news_data) {
                if($news_data['type'] == 'I'){
                    $dir = "../../../admin/posts/files/images/" . $news_data['id'];
                    if (is_dir($dir)) {
                        $dir_data = scandir($dir, 1);
                        $image = reset($dir_data);
                    }
                    $news_data['image_url'] = $_SERVER['DOCUMENT_ROOT'].'/admin/posts/images/'.$image;
                }elseif($news_data['type'] == 'V'){
                    $dir = "../../../admin/posts/files/videos/" . $news_data['id'];
                    if (is_dir($dir)) {
                        $dir_data = scandir($dir, 1);
                        $image = reset($dir_data);
                    }
                    $news_data['image_url'] = $_SERVER['DOCUMENT_ROOT'].'/admin/posts/videos/'.$image;
                }
            }
        }
        return [!empty($news) ? $news : [],!empty($params) ? $params : []];
    }
    function fn_get_news_data($id,$lang_code='en')
    {
        if(empty($id)){
            return false;
        }
        $condition = $limit = $join = '';
        $fields = "tblposts.*,tblpost_descriptions.PostTitle,tblpost_descriptions.PostDetails";
        $condition .= " AND tblpost_descriptions.lang_code = '$lang_code'";
        $condition .= " AND tblposts.is_deleted != 'Y'";
        $join .= " LEFT JOIN tblpost_descriptions ON tblpost_descriptions.id = tblposts.id";
        if (!empty($id)) {
            $condition .= " AND tblposts.id = '".$id."'";
        }
        $query = "SELECT $fields FROM tblposts $join where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $news = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return !empty($news) ? reset($news) : [];
    }
    function fn_get_categories($params = [],$items_per_page = 0,$lang_code = 'en')
    {
        $default_params = array(
            'page' => 1,
            'items_per_page' => $items_per_page
        );
        $params = array_merge($default_params, $params);
        $condition = $limit = $join = '';
        $fields = "tblcategory.*,tblcategory_descriptions.CategoryName,tblcategory_descriptions.Description";
        $condition .= " AND tblcategory_descriptions.lang_code = '$lang_code'";
        // $condition .= " AND tblcategory.is_active != '0'";
        $join .= " LEFT JOIN tblcategory_descriptions ON tblcategory_descriptions.id = tblcategory.id";
        if (!empty($params['CategoryId'])) {
            $condition .= " AND tblcategory.CategoryId = '".$params['CategoryId']."'";
        }
        if (!empty($params['q'])) {
            $condition .= " AND (tblcategory_descriptions.CategoryName LIKE '%".$params['q']."%' OR tblcategory_descriptions.Description LIKE '%".$params['q']."%')";
        }
        if(!empty($params['pagination'])){
            $params['items_per_page'] = $perPage = !empty($params['items_per_page'])?$params['items_per_page']:10;
            $page = (!empty($params['page'])) ? (int)$params['page'] : 1;
            $startAt = $perPage * ($page - 1);
            $query = "SELECT COUNT(*) as total FROM tblcategory $join where 1 $condition";
            $r = mysqli_fetch_assoc(mysqli_query($this->connection,$query));
            $params['totalPages'] = ceil($r['total'] / $perPage);
            $params['page'] = $page;
            $condition .= " ORDER BY 'timestamp' LIMIT $startAt, $perPage";
        }
        $query = "SELECT $fields FROM tblcategory $join where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $categories = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return [!empty($categories) ? $categories : [],!empty($params) ? $params : []];
    }
    function fn_get_category_data($id,$lang_code='en')
    {
        if(empty($id)){
            return false;
        }
        $condition = $limit = $join = '';
        $fields = "tblcategory.*,tblcategory_descriptions.CategoryName,tblcategory_descriptions.Description";
        $condition .= " AND tblcategory_descriptions.lang_code = '$lang_code'";
        $join .= " LEFT JOIN tblcategory_descriptions ON tblcategory_descriptions.id = tblcategory.id";
        if (!empty($id)) {
            $condition .= " AND tblcategory.id = '".$id."'";
        }
        $query = "SELECT $fields FROM tblcategory $join where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $category_data = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return !empty($category_data) ? reset($category_data) : [];
    }
    function fn_get_news_comments($news_id,$params = [],$items_per_page = 0,$lang_code = 'en')
    {
        if(empty($news_id)){
            return false;
        }
        $default_params = array(
            'page' => 1,
            'items_per_page' => $items_per_page
        );
        $params = array_merge($default_params, $params);
        $condition = $limit = $join = '';
        $fields = 'tblcomments.*,users.name,tblpost_descriptions.PostTitle';
        $join = ' INNER JOIN users ON tblcomments.user_id = users.id';
        $join .= ' INNER JOIN tblpost_descriptions ON tblcomments.postId = tblpost_descriptions.id';
        $condition .= " AND tblpost_descriptions.lang_code = '$lang_code'";
        $condition .= " AND tblcomments.postId = '".$news_id."'";
        $condition .= " AND tblcomments.status = 'A'";
        // if (!empty($params['q'])) {
        //     $condition .= " AND (tblcategory_descriptions.CategoryName LIKE '%".$params['q']."%' OR tblcategory_descriptions.Description LIKE '%".$params['q']."%')";
        // }
        if(!empty($params['pagination'])){
            $params['items_per_page'] = $perPage = !empty($params['items_per_page'])?$params['items_per_page']:10;
            $page = (!empty($params['page'])) ? (int)$params['page'] : 1;
            $startAt = $perPage * ($page - 1);
            $query = "SELECT COUNT(*) as total FROM tblcomments $join where 1 $condition";
            $r = mysqli_fetch_assoc(mysqli_query($this->connection,$query));
            $params['totalPages'] = ceil($r['total'] / $perPage);
            $params['page'] = $page;
            $condition .= " ORDER BY 'timestamp' LIMIT $startAt, $perPage";
        }
        $query = "SELECT $fields FROM tblcomments $join where 1 $condition";
        $run = mysqli_query($this->connection, $query);
        $comments = mysqli_fetch_all($run, MYSQLI_ASSOC);
        return [!empty($comments) ? $comments : [],!empty($params) ? $params : []];
    }
    function fn_delete_news_comment($comment_id)
    {
        if(empty($comment_id)){
            return false;
        }
        $condition='';
        $condition .= " AND tblcomments.comment_id = '".$comment_id."'";
        $query = "DELETE FROM `tblcomments` WHERE 1 $condition";
        if (mysqli_query($this->connection, $query)) {
            return true;
        }
    }
    function fn_update_news_comment($comment_id = 0,$data)
    {
        if(!empty($comment_id)){
            //update code
            return true;
        }else{
            if(empty($data['postId']) || empty($data['user_id']) || empty($data['comment'])|| empty($data['status'])){
                return false;
            }
            $postId = $data['postId'];
            $user_id = $data['user_id'];
            $comment = $data['comment'];
            $status = $data['status'];
            $timestamp = time();
            $query = "INSERT INTO `tblcomments`( `postId`, `user_id`, `comment`,`status`,`timestamp`) VALUES ('$postId','$user_id','$comment','$status','$timestamp')";
            if (mysqli_query($this->connection, $query)) {
                $comment_id = $this->connection->insert_id;
            }
        }
        return $comment_id;
            
    }
}
