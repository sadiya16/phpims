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
                    Stock Master</a></div>
        </div>
        <!--End-breadcrumbs-->
        <!--Action boxes-->
        <div class="container-fluid">

            <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                <form class="form-inline" action="" name="form1" method="post">
                    <div class="form-group">
                        <label for="email">Select Start Date</label>
                        <input type="text" name="dt" id="dt" autocomplete="off" class="form-control" required style="width:200px;border-style:solid; border-width:1px; border-color:#666666" value="<?php echo date("Y-m-d") ?>" >
                    </div>
                    <div class="form-group">
                        <label for="email">Select End Date</label>
                        <input type="text" name="dt2" id="dt2" autocomplete="off" value="<?php echo date("Y-m-d") ?>"  class="form-control" style="width:200px;border-style:solid; border-width:1px; border-color:#666666" >
                    </div>
                    <br><br>
                    <div class="controls">
                        <select class="span3" name="party_name" id="party_name"
                                onchange="select_party_name(this.value)">
                            <option>Select</option>
                            <?php
                            $res = mysqli_query($link, "select * from party_info");
                            while ($row = mysqli_fetch_array($res)) {
                                echo "<option>";
                                echo $row["businessname"];
                                echo "</option>";
                            }
                            ?>
                        </select>

                    </div>
                    <br><br>
                    <button type="submit" name="submit1" class="btn btn-success">Show Purchase From These Dates </button>
                    <button type="button" name="submit2" class="btn btn-warning" onclick="window.location.href=window.location.href">Clear Search</button>
                </form>

                <br>


                <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">



                <div class="span12">

                    <div class="widget-content nopadding">

                        <?php
                        if(isset($_POST["party_name"]))
                        {
                            ?>
                            <table class="table table-bordered table-striped" id="total2">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Purchase By</th>
                                    <th>Product Company</th>
                                    <th>Product Name</th>
                                    <th>Product Unit</th>
                                    <th>Packing Size</th>
                                    <th>Product Qty</th>
                                    <th>Price</th>
									<th>Total</th>
                                    <th>Party Name</th>
                                    <th>Purchase Type</th>
                                    <th>Expiry Date</th>
                                    <th>Purchase Date</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count=0;
                                $res = mysqli_query($link, "select * from purchase_master where (purchase_date>='$_POST[dt]' && purchase_date<='$_POST[dt2]' && party_name>='$_POST[party_name]')");
                                while ($row = mysqli_fetch_array($res)) {
                                    $count=$count+1;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row["username"]; ?></td>
                                        <td><?php echo $row["company_name"]; ?></td>
                                        <td><?php echo $row["product_name"]; ?></td>
                                        <td><?php echo $row["unit"]; ?></td>
                                        <td><?php echo $row["packing_size"]; ?></td>
                                        <td><?php echo $row["quantity"]; ?></td>
                                        <td><?php echo $row["price"]; ?></td>
                                        <td class="sum"><?php echo $row["price"]*$row["quantity"]; ?></td>
                                        <td><?php echo $row["party_name"]; ?></td>
                                        <td><?php echo $row["purchase_type"]; ?></td>
                                        <td><?php echo $row["expiry_date"]; ?></td>
                                        <td><?php echo $row["purchase_date"]; ?></td></tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <script language="javascript" type="text/javascript">
                                var tds = document.getElementById('total2').getElementsByTagName('td');
                                var sum = 0;
                                for(var i = 0; i < tds.length; i ++) {
                                    if(tds[i].className == 'sum') {
                                        sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                                    }
                                }
                                document.getElementById('total2').innerHTML += '<tr><td>' + sum + '</td><td>Purchase Total</td></tr>';
                            </script>
                            <?php

                        }

                        else{
                            ?>
                            <table class="table table-bordered table-striped" id ="total">
                                <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Purchase By</th>
                                    <th>Product Company</th>
                                    <th>Product Name</th>
                                    <th>Product Unit</th>
                                    <th>Packing Size</th>
                                    <th>Product Qty</th>
                                    <th>Price</th>
									<th>Total</th>
                                    <th>Party Name</th>
                                    <th>Purchase Type</th>
                                    <th>expiry Date</th>
                                    <th>Purchase Date</th>

                                </tr>

                                </thead>




                                <tbody>


                                <?php
                                $count=0;
                                $res = mysqli_query($link, "select * from purchase_master");
                                while ($row = mysqli_fetch_array($res)) {
                                    $count=$count+1;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row["username"]; ?></td>
                                        <td><?php echo $row["company_name"]; ?></td>
                                        <td><?php echo $row["product_name"]; ?></td>
                                        <td><?php echo $row["unit"]; ?></td>
                                        <td><?php echo $row["packing_size"]; ?></td>
                                        <td><?php echo $row["quantity"]; ?></td>
                                        <td><?php echo $row["price"]; ?></td>
										<td class="sum"><?php echo $row["price"]*$row["quantity"]; ?></td>
                                        <td><?php echo $row["party_name"]; ?></td>
                                        <td><?php echo $row["purchase_type"]; ?></td>
                                        <td><?php echo $row["expiry_date"]; ?></td>
                                        <td><?php echo $row["purchase_date"]; ?></td></tr>
                                    <?php
                                }
                                ?>


                                </tbody>

                            </table>
                            <?php

                        }
                        ?>

                        <script language="javascript" type="text/javascript">
                            var tds = document.getElementById('total').getElementsByTagName('td');
                            var sum = 0;
                            for(var i = 0; i < tds.length; i ++) {
                                if(tds[i].className == 'sum') {
                                    sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
                                }
                            }
                            document.getElementById('total').innerHTML += '<tr><td>' + sum + '</td><td>Purchase Total</td></tr>';
                        </script>
                    </div>

                </div>
            </div>


        </div>


    </div>




<?php
include "footer.php";
?>
