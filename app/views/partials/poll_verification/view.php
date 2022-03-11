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
                    <h4 class="record-title">View  Poll Verification</h4>
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
                                    <tr  class="td-tally_code">
                                        <th class="title"> Tally Code: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['tally_code']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
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
                                    <tr  class="td-election_tally_elective_position">
                                        <th class="title"> Elective Position: </th>
                                        <td class="value"> <?php echo $data['election_tally_elective_position']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_county">
                                        <th class="title"> County: </th>
                                        <td class="value"> <?php echo $data['election_tally_county']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_constituency">
                                        <th class="title"> Constituency: </th>
                                        <td class="value"> <?php echo $data['election_tally_constituency']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_polling_center">
                                        <th class="title"> Polling Center: </th>
                                        <td class="value"> <?php echo $data['election_tally_polling_center']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_polling_station">
                                        <th class="title"> Polling Station: </th>
                                        <td class="value"> <?php echo $data['election_tally_polling_station']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_results_form">
                                        <th class="title"> Results Form: </th>
                                        <td class="value"><?php Html :: page_link_file($data['election_tally_results_form']); ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_votes">
                                        <th class="title"> Garnered Votes: </th>
                                        <td class="value"> <?php echo $data['election_tally_votes']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_total_votes">
                                        <th class="title"> Total Votes: </th>
                                        <td class="value"> <?php echo $data['election_tally_total_votes']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_rejected_votes">
                                        <th class="title"> Rejected Votes: </th>
                                        <td class="value"> <?php echo $data['election_tally_rejected_votes']; ?></td>
                                    </tr>
                                    <tr  class="td-election_tally_spoilt_votes">
                                        <th class="title"> Spoilt Votes: </th>
                                        <td class="value"> <?php echo $data['election_tally_spoilt_votes']; ?></td>
                                    </tr>
                                    <tr  class="td-status">
                                        <th class="title"> Status: </th>
                                        <td class="value">
                                            <span  data-source='<?php echo json_encode_quote(Menu :: $status); ?>' 
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
                                                class="is-editable" >
                                                <?php echo $data['status']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-user">
                                        <th class="title"> User: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['user']; ?>" 
                                                data-pk="<?php echo $data['id'] ?>" 
                                                data-url="<?php print_link("poll_verification/editfield/" . urlencode($data['id'])); ?>" 
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("poll_verification/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> Edit
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
