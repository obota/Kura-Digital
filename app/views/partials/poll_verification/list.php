<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("poll_verification/add");
$can_edit = ACL::is_allowed("poll_verification/edit");
$can_view = ACL::is_allowed("poll_verification/view");
$can_delete = ACL::is_allowed("poll_verification/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Poll Verification</h4>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('poll_verification'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('poll_verification'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('poll_verification'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3">
                                <div class="card-header h4 h4">Filter by Poll Verification Status</div>
                                <div class="p-2">
                                    <?php 
                                    $poll_verification_status_options = $comp_model -> poll_verification_poll_verificationstatus_option_list();
                                    if(!empty($poll_verification_status_options)){
                                    foreach($poll_verification_status_options as $option){
                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                    $checked = $this->set_field_checked('poll_verification_status', $value);
                                    ?>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="radio"  name="poll_verification_status"  />
                                            <span class="custom-control-label"><?php echo $label; ?></span>
                                        </label>
                                        <?php
                                        }
                                        }
                                        ?>
                                        
                                        <div class="form-group text-center">
                                                        <button class="btn btn-primary">Filter</button>
                                                    </div>
                                    </div>
                                </div>
                                <?php $this :: display_page_errors(); ?>
                                <div class="filter-tags mb-2">
                                    <?php
                                    if(!empty(get_value('poll_verification_status'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Poll Verification Status :</b> 
                                        <?php 
                                        if(get_value('poll_verification_statuslabel')){
                                        echo get_value('poll_verification_statuslabel');
                                        }
                                        else{
                                        echo get_value('poll_verification_status');
                                        }
                                        $remove_link = unset_get_value('poll_verification_status', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div  class=" animated fadeIn page-content">
                                    <div id="poll_verification-list-records">
                                        <div id="page-report-body" class="table-responsive">
                                            <table class="table  table-striped table-sm text-left">
                                                <thead class="table-header bg-light">
                                                    <tr>
                                                        <th class="td-sno">#</th>
                                                        <th  class="td-tally_code"> Tally Code</th>
                                                        <th  <?php echo (get_value('orderby')=='date' ? 'class="sortedby td-date"' : null); ?>>
                                                            <?php Html :: get_field_order_link('date', "Date"); ?>
                                                        </th>
                                                        <th  class="td-election_tally_elective_position"> Elective Position</th>
                                                        <th  class="td-election_tally_county"> County</th>
                                                        <th  class="td-election_tally_constituency"> Constituency</th>
                                                        <th  class="td-election_tally_polling_center"> Polling Center</th>
                                                        <th  class="td-election_tally_polling_station"> Polling Station</th>
                                                        <th  class="td-votes"> Garnered Votes</th>
                                                        <th  class="td-total_votes"> Total Votes</th>
                                                        <th  class="td-results_form"> Results Form</th>
                                                        <th  class="td-status"> Status</th>
                                                        <th  class="td-user"> Verified By</th>
                                                        <th class="td-btn"></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if(!empty($records)){
                                                ?>
                                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <!--record-->
                                                    <?php
                                                    $counter = 0;
                                                    $sum_of_votes = 0;
                                                    $sum_of_total_votes = 0;
                                                    foreach($records as $data){
                                                    $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                    $counter++;
                                                    $sum_of_votes = $sum_of_votes + $data['votes'];
                                                    $sum_of_total_votes = $sum_of_total_votes + $data['total_votes'];
                                                    ?>
                                                    <tr>
                                                        <th class="td-sno"><?php echo $counter; ?></th>
                                                        <td class="td-tally_code">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['tally_code']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="tally_code" 
                                                                data-title="Enter Tally Code" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['tally_code']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-date">
                                                            <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                                data-value="<?php echo $data['date']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="date" 
                                                                data-title="Enter Date" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="flatdatetimepicker" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['date']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-election_tally_elective_position">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $elective_position); ?>' 
                                                                data-value="<?php echo $data['election_tally_elective_position']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="elective_position" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="select" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['election_tally_elective_position']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-election_tally_county">
                                                            <span <?php if($can_edit){ ?> data-sourceurl="<?php print_link('api/json/poll_verification_election_tally_county_option_list'); ?>" 
                                                                data-source='<?php print_link('api/json/poll_verification_election_tally_county_option_list'); ?>' 
                                                                data-value="<?php echo $data['election_tally_county']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="county" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="selectize" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable selectize" <?php } ?>>
                                                                <?php echo $data['election_tally_county']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-election_tally_constituency">
                                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                                $dependent_field = (!empty($data['county']) ? urlencode($data['county']) : null);
                                                                print_link('api/json/poll_verification_election_tally_constituency_option_list/'.$dependent_field); 
                                                                ?>' 
                                                                data-value="<?php echo $data['election_tally_constituency']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="constituency" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="selectize" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable selectize" <?php } ?>>
                                                                <?php echo $data['election_tally_constituency']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-election_tally_polling_center">
                                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                                $dependent_field = (!empty($data['constituency']) ? urlencode($data['constituency']) : null);
                                                                print_link('api/json/poll_verification_election_tally_polling_center_option_list/'.$dependent_field); 
                                                                ?>' 
                                                                data-value="<?php echo $data['election_tally_polling_center']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="polling_center" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="selectize" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable selectize" <?php } ?>>
                                                                <?php echo $data['election_tally_polling_center']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-election_tally_polling_station">
                                                            <span <?php if($can_edit){ ?> data-source='<?php 
                                                                $dependent_field = (!empty($data['polling_center']) ? urlencode($data['polling_center']) : null);
                                                                print_link('api/json/poll_verification_election_tally_polling_station_option_list/'.$dependent_field); 
                                                                ?>' 
                                                                data-value="<?php echo $data['election_tally_polling_station']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="polling_station" 
                                                                data-title="Select a value ..." 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="selectize" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable selectize" <?php } ?>>
                                                                <?php echo $data['election_tally_polling_station']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-votes">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['votes']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="votes" 
                                                                data-title="Enter Garnered Votes" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['votes']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-total_votes">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['total_votes']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="total_votes" 
                                                                data-title="Enter Total Votes" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['total_votes']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-results_form"><?php Html :: page_link_file($data['results_form']); ?></td>
                                                        <td class="td-status">
                                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $status); ?>' 
                                                                data-value="<?php echo $data['status']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="status" 
                                                                data-title="Enter Status" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="radiolist" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['status']; ?> 
                                                            </span>
                                                        </td>
                                                        <td class="td-user">
                                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user']; ?>" 
                                                                data-pk="<?php echo $data['id'] ?>" 
                                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
                                                                data-name="user" 
                                                                data-title="Enter User" 
                                                                data-placement="left" 
                                                                data-toggle="click" 
                                                                data-type="text" 
                                                                data-mode="popover" 
                                                                data-showbuttons="left" 
                                                                class="is-editable" <?php } ?>>
                                                                <?php echo $data['user']; ?> 
                                                            </span>
                                                        </td>
                                                        <th class="td-btn">
                                                            <?php if($can_view){ ?>
                                                            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("poll_verification/view/$rec_id"); ?>">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                            <?php } ?>
                                                            <?php if($can_edit){ ?>
                                                            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("poll_verification/edit/$rec_id"); ?>">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                            <?php } ?>
                                                        </th>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <!--endrecord-->
                                                </tbody>
                                                <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                                <tfoot><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>Total Garnered Votes = <?php echo $sum_of_votes;  ?></th><th>Total Cumulative Votes = <?php echo $sum_of_total_votes;  ?></th><th></th><th></th><th></th><th></th></tr></tfoot>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                            <?php 
                                            if(empty($records)){
                                            ?>
                                            <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                                <i class="fa fa-ban"></i> No record found
                                            </h4>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if( $show_footer && !empty($records)){
                                        ?>
                                        <div class=" border-top mt-2">
                                            <div class="row justify-content-center">    
                                                <div class="col-md-auto justify-content-center">    
                                                    <div class="p-3 d-flex justify-content-between">    
                                                        <div class="dropup export-btn-holder mx-1">
                                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-save"></i> Export
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                    </a>
                                                                    <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                        </a>
                                                                        <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                            </a>
                                                                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                                </a>
                                                                                <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                                <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                    <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">   
                                                                        <?php
                                                                        if($show_pagination == true){
                                                                        $pager = new Pagination($total_records, $record_count);
                                                                        $pager->route = $this->route;
                                                                        $pager->show_page_count = true;
                                                                        $pager->show_record_count = true;
                                                                        $pager->show_page_limit =true;
                                                                        $pager->limit_count = $this->limit_count;
                                                                        $pager->show_page_number_list = true;
                                                                        $pager->pager_link_range=5;
                                                                        $pager->render();
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
