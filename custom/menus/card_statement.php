<?php
require_once('../includes/config.inc.php');

session_start();
$userid = $_SESSION['uid'];

$link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD) or die("could not connect to host.");
mysqli_select_db($link, DB_DATABASE) or die("could not find db.");


if ($userid == 1) {
    $min_q = "SELECT MIN(transno) AS min FROM cardstatement";
} else {
    $min_q = "SELECT MIN(transno) AS min FROM cardstatement WHERE uid = $userid";
}

$min_transno = mysqli_query($link, $min_q) or die("Data not found");
$minn = mysqli_fetch_array($min_transno);
$min = $minn['min'];

$query = "SELECT * FROM cardstatement WHERE transno = $min";


$result = mysqli_query($link, $query) or die("Data not found");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Card Statement</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <form name="card">
                    <div class="form-group">
                        <label>Transaction No</label>
                        <input class="form-control" id="transno" name="transno" type="number" value=<?php echo $row['transno']; ?> min="0" maxlength="255" readonly>
                    </div>

                    <div class="form-group">
                        <label>User ID</label>
                        <input class="form-control" id="userid" name="userid" type="number" value=<?php echo $row['uid']; ?> maxlength="255" readonly>
                    </div>

                    <div class="form-group">
                        <label>Card No.</label>
                        <input class="form-control" id="cardno" name="cardno" value=<?php echo $row['number']; ?> readonly>
                    </div>

                    <div class="form-group">
                        <label>Date</label>
                        <input class="form-control" id="date" name="date" type="date" value=<?php echo $row['date']; ?> readonly>
                    </div>

                    <div class="form-group">
                        <label>Seller No</label>
                        <input class="form-control" id="sellerno" name="sellerno" type="text"  value=<?php echo $row['sellerno']; ?> readonly>
                    </div>

                    <div class="form-group">
                        <label>Product</label>
                        <input class="form-control" id="product" name="product" type="text"  value=<?php echo $row['product']; ?> readonly>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" id="price" name="price" type="text" type="number" value=<?php echo $row['price']; ?> readonly>
                    </div>
                <?php } ?>

                <div class="col-lg-6">
                    <input class="btn btn-default" id="previous" type="button"  name="Previous" value="Previous">
                    <input class="btn btn-default" id="edit" type="button" name="Edit" value="Edit" >
                    <input id="save" type="button" class="btn btn-default" name="save" value="Save" disabled>
                    <input class="btn btn-default" id="insert" type="button" name="Insert" value="Insert">
                    <input class="btn btn-default" id="next" type="button" name="Next" value="Next" >
                </div>


            </form>
        </div>
    </div>
</div>
