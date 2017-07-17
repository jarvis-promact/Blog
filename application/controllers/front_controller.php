<?php

Class Front_controller extends CI_Controller
{
    public function index()
    {
        $this->load->model('front_model');
        $this->load->library("pagination");
        $data["getCat"]= $this->front_model->getCat();
        $data["getTag"]= $this->front_model->getTag();
        $limit=5;
        $start=0;
        
        $config=array();
        $config["base_url"] = base_url()."front_controller/index";
        $config["total_rows"] = $this->front_model->record_count();
        $config["per_page"] = 5;
        $config["num_links"] = 2;
        
        $config["use_page_numbers"] = TRUE;
        $config["full_tag_open"] = '<ul class="pagination">';
        $config["full_tag_close"] = '</ul>';
        $config["first_tag_open"] = '<li>';
        $config["first_tag_close"] = '</li>';
        $config["last_tag_open"] = '<li>';
        $config["last_tag_close"] = '</li>';
        $config["next_link"] = '&gt';
        $config["next_tag_open"] = '<li>';
        $config["next_tag_close"] = '</li>';
        $config["prev_link"] = '&lt';
        $config["prev_tag_open"] = '<li>';
        $config["prev_tag_close"] = '</li>';
        $config["cur_tag_open"] = "<li class='active'><a href='#'>";
        $config["cur_tag_close"] = "</a></li>";
        $config["num_tag_open"] = "<li>";
        $config["num_tag_close"] = "</li>";
        
        
        $this->pagination->initialize($config);
        
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
            }
            else{
            $page = 0;
        }
        $start=($page-1)*$config["per_page"];
        $category_id= $this->uri->segment(3);   
        $tag_id= $this->uri->segment(3);   
        $data["fetch_data"] = $this->front_model->fetch_data($config["per_page"],$page);
        $data["result"] = $this->front_model->fetch_by_id($category_id,$tag_id);
        $data["links"] = $this->pagination->create_links();

        $this->load->view('front_view',$data);
    }
        
    public function search_post()
    {
        $this->load->model('front_model');
        $post_title= $this->input->post('search');
              
        if(isset($post_title) and !empty($post_title))
        {
            $data["fetch_data"] = $this->front_model->search_post($post_title);
            $data["links"] = '';
            $data["getCat"]= $this->front_model->getCat();
            $data["getTag"]= $this->front_model->getTag();
            $this->load->view('front_view',$data);
        }else{
            redirect($this->index());
        }
    }
 
    public function fetch_by_id()
      {
            $config=array();
            $config["per_page"] = 5;
            $page = ($this->uri->segment(3)) ;
            $category_id= $this->uri->segment(3);   
            $tag_id= $this->uri->segment(3); 
            $this->load->model('front_model');
            $data["fetch_data"]= $this->front_model->fetch_data($config["per_page"],$page);
            $data["fetch_data"] = $this->front_model->fetch_by_id($category_id,$tag_id);
            $data["links"] = '';
            $data["getCat"]= $this->front_model->getCat();
            $data["getTag"]= $this->front_model->getTag();
            $data["links"] = $this->pagination->create_links();
            $this->load->view("front_view",$data);
      }
      
      public function read_more()
      {                    
            $post_id= $this->uri->segment(3); 
            $this->load->model('front_model');
            $data["fetch_data"] = $this->front_model->read_more($post_id);
            $data["getCat"]= $this->front_model->getCat();
            $data["getTag"]= $this->front_model->getTag();
            $this->load->view("read_more",$data);
      }
}