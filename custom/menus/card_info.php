<?php
    require_once('../includes/config.inc.php');

    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
    mysqli_select_db($link, DB_DATABASE)  or die("could not find db.");

    $query = "SELECT * FROM cardinfo";

    $result = mysqli_query($link, $query) or die("Data not found");
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Card Infos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr >
                                <th>Name</th>
                                <th>Number</th>
                                <th>Issuer</th>
                                <th>Expiration</th>
                                <th>Limit</th>
                                <th>Currency</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['number'];?></td>
                                <td><?php echo $row['issuer'];?></td>
                                <td><?php echo $row['exp'];?></td>
                                <td><?php echo $row['limit'];?></td>
                                <td><?php echo $row['currency'];?></td>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                <div class="well">
                    <h4>DataTables Usage Information</h4>
                    <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                    <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
