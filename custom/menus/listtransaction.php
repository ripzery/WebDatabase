<?php

    $xmlObject = simplexml_load_file("../xml/transactions.xml");
        
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
                                <th>Price</th>
                                <th>Credit Card No.</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php
                                foreach ($xmlObject->transactions->transaction AS $transaction) {
                            ?>
                            <tr>
                                <td><?php echo $transaction->transno;?></td>
                                <td><?php echo $transaction->uid;?></td>
                                <td><?php echo $transaction->date;?></td>
                                <td><?php echo $transaction->sellerno;?></td>
                                <td><?php echo $transaction->product;?></td>
                                <td><?php echo $transaction->price;?></td>
                                <td><?php echo $transaction->number;?></td>
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