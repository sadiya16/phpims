<?php
session_start();
if(!isset($_SESSION["admin"]))
{
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
?>

<?php
include "header.php";
include "../user/connection.php";
?>
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"><a href="#" class="tip-bottom"><i class="icon-home"></i>
                    Party Report</a></div>
        </div>
        <!--End-breadcrumbs-->
        <!--Action boxes-->
        <div class="container-fluid">
            <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                <div class="span12">

                    <form class="form-inline" action="" name="form1" method="post">
                        <div class="form-group">
                            <label for="email">Select Company Name</label>
                            <select class="form-control" name="company_name">
                                <?php
                                $res=mysqli_query($link,"select * from party_info");
                                while($row=mysqli_fetch_array($res))
                                {
                                    echo "<option>";
                                    echo $row["businessname"];
                                    echo "</option>";
                                }
                                ?>
                            </select>

                        </div>
                        <button type="submit" name="submit1" class="btn btn-success">Show Purchase From This Company</button>
                    </form>

                    <br>




                    <div class="widget-content nopadding">

                        <?php
                        if(isset($_POST["submit1"]))
                        {
                            ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Product Company</th>
                                <th>Product Name</th>
                                <th>Product Unit</th>
                                <th>Packing Size</th>
                                <th>Product Qty</th>
                                <th>Price</th>
                                <th>Party Name</th>
                                <th>Purchase Type</th>
                                <th>Expiry Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count=0;
                            $res = mysqli_query($link, "select * from purchase_master where party_name='$_POST[company_name]'");
                            while ($row = mysqli_fetch_array($res)) {
                                $count=$count+1;
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $row["company_name"]; ?></td>
                                    <td><?php echo $row["product_name"]; ?></td>
                                    <td><?php echo $row["unit"]; ?></td>
                                    <td><?php echo $row["packing_size"]; ?></td>
                                    <td><?php echo $row["quantity"]; ?></td>
                                    <td><?php echo $row["price"]; ?></td>
                                    <td><?php echo $row["party_name"]; ?></td>
                                    <td><?php echo $row["purchase_type"]; ?></td>
                                    <td><?php echo $row["expiry_date"]; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <?php
                        }

                        ?>

                        </table>
                    </div>

                </div>
            </div>


        </div>


    </div>



<?php
include "footer.php";
?>