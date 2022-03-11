<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Agent Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-4 comp-grid">
                    <a  class="btn btn-primary" href="<?php print_link("election_tally/add") ?>">
                        <i class="fa fa-clone fa-2x"></i>                               
                        Submit Election Tally 
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
