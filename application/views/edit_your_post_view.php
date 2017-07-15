<!DOCTYPE html>
<html>
<head>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
</head>
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">BLOGGING</a>
        </div>
        <div class="nav navbar-nav pull-right">
            <ul class="nav navbar-nav">
                 <li><a href="<?php echo base_url()?>after_login_controller/get_profile">HOME</a></li>
           <li class="dropdown pull-right"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <span class="glyphicon glyphicon-user"><span class="glyphicon glyphicon-menu-down"></span></span>
             <ul class="dropdown-menu">
                <li><a href="<?php echo base_url()?>after_login_controller/get_profile">YOUR POSTS</a></li>
               <li><a href="<?php echo base_url()?>after_login_controller/logout">LOGOUT</a></li>                          
             </ul>
           </li>
         </ul>
       </div>       
      </div>
     </nav>
<style>
.glyphicon {
    font-size: 20px;
}
body {
    font-family: "Lato", sans-serif;
    transition: background-color .5s;
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}

.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.sidenav a:hover, .offcanvas a:focus{
    color: #f1f1f1;
}

.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#main {
    transition: margin-left .5s;
    padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>  
     <div class="containter">
    <form method="post" action="<?php echo base_url()?>post_controller/post_form_validation">
        <?php
                 if(isset($user_data))
                {
                    foreach($user_data->result() as $row)
                    {
                        ?>
                <h1 align="center"><b>Edit Your Post</b></h1><br/>
                  <fieldset class="well the-fieldset">
                                 <div class="form-group">
                                    <label>Post Title</label>
                                    <input type="text" name="post_title" value="<?php echo $row->post_title; ?>" class="form-control"/>
                                    <span class="text-danger"><?php echo form_error("post_title"); ?></span>
                                </div>        
                                 <div class="form-group">
                                    <label>Post Content</label>
                                    <input type="text" name="post_content" value="<?php echo $row->post_content; ?>" class="form-control"/>
                                    <span class="text-danger"><?php echo form_error("post_content"); ?></span>
                                </div>            
                                <div>
                                     <label>Category</label>
                                     <select name="category" class="form-control">
                                         <option value="">Select</option>
                                    <?php if(count($getCat)): ?>
                                         <?php foreach($getCat as $categories): ?>
                                          <option value="<?php echo $categories->category_id ?>"<?php if($row->category_id==$categories->category_id) echo 'selected="selected"'; ?>><?php echo $categories->category_name ?></option>
                                         <?php endforeach;?>
                                     <?php else :?>
                                         <?php endif; ?>
                                    </select>
                                        <span class="text-danger"><?php echo form_error("category"); ?></span>
                                    </div>
                                   <div>
                                        <label>Tags</label><br>
                                       <?php   $array = explode(',',$row->tag_id); ?>   
                                        <select class="form-control" id="tag" multiple="multiple" name="tag[]">
                                            <option value="">Select</option>
                                       <?php if(count($getTag)): ?>
                                            <?php foreach($getTag as $tags): ?>
                                          <option value="<?php echo $tags->tag_id ?>"<?php if(in_array($tags->tag_id,$array)) echo 'selected="selected"'; ?>><?php echo $tags->tag_name ?></option>
                                            <?php endforeach;?>
                                        <?php else :?>
                                            <?php endif; ?>
                                       </select>
                                          <span class="text-danger"><?php echo form_error("tag"); ?></span>
                                       </div>                      
                                      <div class="form-group">
                                <input type="hidden" name="hidden_id" value="<?php echo $row->post_id; ?>">
                                <input type="submit" name="update_your_post" value="SAVE" class="btn btn-info center-block btn-sx"/><br><br>
                              <input type="reset" name="reset" value="CANCEL" class="btn btn-info center-block btn-sx"/>
                        </div>
                        </fieldset>
                        <?php
                    }
                }
                ?>
    </form>
     </div>
</body>
 <script type="text/javascript">
         $(document).ready(function(){
       $('#tag').multiselect();
       });
     </script>
</html>