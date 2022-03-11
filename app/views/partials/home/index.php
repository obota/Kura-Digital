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
    <div  class="">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="col-md-7 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->barchart_datasetfromconstituencytally();
                        ?>
                        <div>
                            <h4>Dataset from Constituency Tally</h4>
                            <small class="text-muted">Summary of Candidate Performance per Constituency</small>
                        </div>
                        <hr />
                        <canvas id="barchart_datasetfromconstituencytally"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Dataset from Constituency Votes',
                            backgroundColor:[
                            <?php 
                            foreach($chartdata['labels'] as $g){
                            echo "'" . random_color(0.9) . "',";
                            }
                            ?>
                            ],
                            borderColor:'RANDOMDIFFERENTCOLOR',
                            type:'',
                            borderWidth:1,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('barchart_datasetfromconstituencytally');
                            var chart = new Chart(ctx, {
                            type:'bar',
                            data: chartData,
                            options: {
                            scaleStartValue: 0,
                            responsive: true,
                            scales: {
                            xAxes: [{
                            ticks:{display: true},
                            gridLines:{display: true},
                            categoryPercentage: 1.0,
                            barPercentage: 0.8,
                            scaleLabel: {
                            display: true,
                            labelString: "Constituency"
                            },
                            }],
                            yAxes: [{
                            ticks: {
                            beginAtZero: true,
                            display: true
                            },
                            scaleLabel: {
                            display: true,
                            labelString: "Votes Garnered per Contituency"
                            }
                            }]
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
                <div class="col-md-5 comp-grid">
                    <div class="card card-body">
                        <?php 
                        $chartdata = $comp_model->piechart_tallyverification();
                        ?>
                        <div>
                            <h4>Tally Verification</h4>
                            <small class="text-muted">Summary of Verified and Unverified Tally</small>
                        </div>
                        <hr />
                        <canvas id="piechart_tallyverification"></canvas>
                        <script>
                            $(function (){
                            var chartData = {
                            labels : <?php echo json_encode($chartdata['labels']); ?>,
                            datasets : [
                            {
                            label: 'Dataset from Poll Verification',
                            borderColor:'RANDOMDIFFERENTCOLOR',
                            backgroundColor:[
                            <?php 
                            foreach($chartdata['labels'] as $g){
                            echo "'" . random_color(0.9) . "',";
                            }
                            ?>
                            ],
                            borderWidth:1,
                            data : <?php echo json_encode($chartdata['datasets'][0]); ?>,
                            }
                            ]
                            }
                            var ctx = document.getElementById('piechart_tallyverification');
                            var chart = new Chart(ctx, {
                            type:'pie',
                            data: chartData,
                            options: {
                            responsive: true,
                            scales: {
                            yAxes: [{
                            ticks:{display: false},
                            gridLines:{display: false},
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }],
                            xAxes: [{
                            ticks:{display: false},
                            gridLines:{display: false},
                            scaleLabel: {
                            display: true,
                            labelString: ""
                            }
                            }],
                            },
                            }
                            ,
                            })});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
