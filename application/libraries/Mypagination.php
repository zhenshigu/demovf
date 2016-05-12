<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mypagination{
    protected $CI;
    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        $this->CI->load->library('pagination');
    }
    //分页函数
    function paginagtion($pageCount,$count,$from,$baseurl){
        $config['base_url'] = $baseurl;
        //$config['uri_segment'] = 4;
        $config['total_rows']=$count;
        $config['per_page'] = $pageCount; 
        $config['num_links'] = 2;
        $config ['first_link'] = '首页';
        $config ['last_link'] = '末页';
        $config ['next_link'] = '下一页>';
        $config ['prev_link'] = '<上一页';
//        $config['enable_query_strings']=FALSE;
//        $config['page_query_string'] = TRUE;
        $this->CI->pagination->initialize($config);
        return $this->CI->pagination->create_links();
    }
}