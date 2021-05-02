<?php
include "header.php";
include "../user/connection.php";
?>



    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb"><a href="#" class="tip-bottom"><i class="icon-home"></i>
                    Return Products Lists</a></div>
        </div>
        <!--End-breadcrumbs-->

        <!--Action boxes-->
        <div class="container-fluid">

            <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
                <table class="table table-bordered">
                    <tr>
                        <th>Bill No</th>
                        <th>Return Date</th>
                        <th>Product Company</th>
                        <th>Product Name</th>
                        <th>Product Unit</th>
                        <th>Packing Size</th>
                        <th>Product Price</th>
                        <th>Product Qty</th>
                        <th>Total</th>
                    </tr>

                    <?php
                    $res=mysqli_query($link,"select * from return_products");
                    while($row=mysqli_fetch_array($res))
                    {
                        echo "<tr>";
                        echo "<td>"; echo $row["bill_no"];  echo "</td>";
                        echo "<td>"; echo $row["return_date"];  echo "</td>";
                        echo "<td>"; echo $row["product_company"];  echo "</td>";
                        echo "<td>"; echo $row["product_name"];  echo "</td>";
                        echo "<td>"; echo $row["product_unit"];  echo "</td>";
                        echo "<td>"; echo $row["packing_size"];  echo "</td>";
                        echo "<td>"; echo $row["product_price"];  echo "</td>";
                        echo "<td>"; echo $row["product_qty"];  echo "</td>";
                        echo "<td>"; echo $row["total"];  echo "</td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
            </div>

        </div>
    </div>

<?php
include "footer.php";
?>