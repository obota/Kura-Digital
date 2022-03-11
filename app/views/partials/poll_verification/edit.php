<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit"  data-display-type="" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Edit  Poll Verification</h4>
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
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("poll_verification/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tally_code">Tally Code </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-tally_code"  value="<?php  echo $data['tally_code']; ?>" type="text" placeholder="Enter Tally Code"  readonly name="tally_code"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="status">Status </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <?php
                                                    $status_options = Menu :: $status;
                                                    $field_value = $data['status'];
                                                    if(!empty($status_options)){
                                                    foreach($status_options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if value is among checked options
                                                    $checked = $this->check_form_field_checked($field_value, $value);
                                                    ?>
                                                    <label class="custom-control custom-radio custom-control-inline">
                                                        <input id="ctrl-status" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio"   name="status" />
                                                            <span class="custom-control-label"><?php echo $label ?></span>
                                                        </label>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-ajax-status"></div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">
                                            Update
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
