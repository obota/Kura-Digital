<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("election_tally/add");
$can_edit = ACL::is_allowed("election_tally/edit");
$can_view = ACL::is_allowed("election_tally/view");
$can_delete = ACL::is_allowed("election_tally/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">View  Election Tally</h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <div class=" reset-grids">
                        <?php  
                        $this->render_page("poll_verification/add" , array( 'tally_code' => $data['tally_code'],'results_form' => $data['results_form'],'votes' => $data['votes'],'total_votes' => $data['total_votes'] )); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
