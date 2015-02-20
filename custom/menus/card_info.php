<?php
    require_once('../includes/config.inc.php');

    session_start();
    
    $userid = $_SESSION['uid'];
    
    $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
    mysqli_select_db($link, DB_DATABASE)  or die("could not find db.");

    $query = $userid == 1 ? "SELECT * FROM cardinfo" : "SELECT * FROM cardinfo where uid = $userid";

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
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
