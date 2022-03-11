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
                    <h4 >The Dashboard</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_totalpollingstations();  ?>
                    <a class="animated zoomIn record-count alert alert-info"  href="<?php print_link("polling_centers/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-institution fa-2x "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Total Polling Stations</div>
                                    <small class="">Total Polling Stations</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_verifiedvotingtally();  ?>
                    <a class="animated zoomIn record-count card bg-success text-white"  href="<?php print_link("poll_verification/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-check-square-o fa-2x "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Verified Voting Tally</div>
                                    <small class="">Total Verified Polling Station Votes</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_unverifiedvotingtally();  ?>
                    <a class="animated zoomIn record-count card bg-danger text-white"  href="<?php print_link("poll_verification/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-close fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Unverified Voting Tally</div>
                                    <small class="">Total Unverified Polling Station Votes</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
