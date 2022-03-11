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
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-date">
                                        <th class="title"> Date: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['date']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="date" 
                                                data-title="Enter Date" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['date']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-elective_position">
                                        <th class="title"> Elective Position: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $elective_position); ?>' 
                                                data-value="<?php echo $data['elective_position']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="elective_position" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['elective_position']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-county">
                                        <th class="title"> County: </th>
                                        <td class="value">
                                            <span  data-sourceurl="<?php print_link('api/json/election_tally_county_option_list'); ?>" 
                                                data-source='<?php print_link('api/json/election_tally_county_option_list'); ?>' 
                                                data-value="<?php echo $data['county']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="county" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" >
                                                <?php echo $data['county']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-constituency">
                                        <th class="title"> Constituency: </th>
                                        <td class="value">
                                            <span  data-source='<?php 
                                                $dependent_field = (!empty($data['county']) ? urlencode($data['county']) : null);
                                                print_link('api/json/election_tally_constituency_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['constituency']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="constituency" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" >
                                                <?php echo $data['constituency']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-polling_center">
                                        <th class="title"> Polling Center: </th>
                                        <td class="value">
                                            <span  data-source='<?php 
                                                $dependent_field = (!empty($data['constituency']) ? urlencode($data['constituency']) : null);
                                                print_link('api/json/election_tally_polling_center_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['polling_center']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="polling_center" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" >
                                                <?php echo $data['polling_center']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-polling_station">
                                        <th class="title"> Polling Station: </th>
                                        <td class="value">
                                            <span  data-source='<?php 
                                                $dependent_field = (!empty($data['polling_center']) ? urlencode($data['polling_center']) : null);
                                                print_link('api/json/election_tally_polling_station_option_list/'.$dependent_field); 
                                                ?>' 
                                                data-value="<?php echo $data['polling_station']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="polling_station" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="selectize" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable selectize" >
                                                <?php echo $data['polling_station']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-total_votes">
                                        <th class="title"> Total Votes: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['total_votes']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="total_votes" 
                                                data-title="Enter Total Votes" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['total_votes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-votes">
                                        <th class="title"> Votes: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['votes']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="votes" 
                                                data-title="Enter Votes" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['votes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rejected_votes">
                                        <th class="title"> Rejected Votes: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['rejected_votes']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="rejected_votes" 
                                                data-title="Enter Rejected Votes" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['rejected_votes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-spoilt_votes">
                                        <th class="title"> Spoilt Votes: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['spoilt_votes']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="spoilt_votes" 
                                                data-title="Enter Spoilt Votes" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['spoilt_votes']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-results_form">
                                        <th class="title"> Results Form: </th>
                                        <td class="value"><?php Html :: page_link_file($data['results_form']); ?></td>
                                    </tr>
                                    <tr  class="td-tally_code">
                                        <th class="title"> Tally Code: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['tally_code']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="tally_code" 
                                                data-title="Enter Tally Code" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['tally_code']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-user">
                                        <th class="title"> User: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['user']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("election_tally/editfield/" . urlencode($data['id'])); ?>" 
                                                data-name="user" 
                                                data-title="Enter User" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['user']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("election_tally/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("election_tally/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> Delete
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> No Record Found
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
