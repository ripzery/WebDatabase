<?php

    $xml = simplexml_load_file($filename)

?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Credit Card Information</h1>
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
                                <th>Transaction No.</th>
                                <th>User ID</th>
                                <th>Date</th>
                                <th>Seller No.</th>
                                <th>Product</th>
                                <th>Credit Card No.</th>
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