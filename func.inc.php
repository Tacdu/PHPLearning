<?php
require_once 'database.php';

//Establish connection
$db = new Database('localhost','root','', 'used_book_portal');
$conn = $db->connect();

//Define search function
function search_results($conn,$keywords){
    $returned_results = array();
    $where = "";
    
    $keywords = preg_split('/[\s]+/', $keywords);
    
    $total_keywords = count($keywords);

    //Keywords search    
    foreach ($keywords as $key=>$keyword){
        $where .= "txt_Keywords LIKE '%$keyword%' ";
        if ($key != ($total_keywords -1)){
            $where .= " AND ";
        }       
    }
    
    $where .= " OR ";

    //Book Name search    
    foreach ($keywords as $key=>$keyword){
        $where .= "txt_Book_name LIKE '%$keyword%' ";
        if ($key != ($total_keywords -1)){
            $where .= " OR ";
        } 
    }
    
    $where .= " OR ";

    //Subject search    
    foreach ($keywords as $key=>$keyword){
        $where .= "txt_Subject LIKE '%$keyword%' ";
        if ($key != ($total_keywords -1)){
            $where .= " OR ";
        } 
    }
    
    $where .= " OR ";

    //Year level search    
    foreach ($keywords as $key=>$keyword){
        $where .= "txt_Year_level LIKE '%$keyword%' ";
        if ($key != ($total_keywords -1)){
            $where .= " OR ";
        } 
    }
   
    //Construct SQL query
    $results = "SELECT txt_Book_name, txt_Category, txt_Year_level, txt_Subject, int_Price, txt_Condition, txt_Description FROM books WHERE $where";
    
    $results_num = ($results = mysqli_query($conn,$results)) ? mysqli_num_rows($results) : 0;
    
    if ($results_num == 0) {
        return false;
    } else {
        while ($results_row = mysqli_fetch_assoc($results)){
            $returned_results[] = array (
                                'bookname' => $results_row['txt_Book_name'],
                                'category' => $results_row['txt_Category'],
                                'yearlevel' => $results_row['txt_Year_level']
            );
        }
        return $returned_results;
    }
}
?>