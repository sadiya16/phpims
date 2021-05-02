<?php
session_start();
include "../../user/connection.php";
$company_name=$_GET["company_name"];
$product_name=$_GET["product_name"];
$unit=$_GET["unit"];
$packing_size=$_GET["packing_size"];
$price=$_GET["price"];
$qty=$_GET["qty"];
$total=$_GET["total"];



if(isset($_SESSION['cart']))
{

    $max=sizeof($_SESSION['cart']);
    $check_available=0;
    $check_available=check_duplicate_product($company_name,$product_name,$unit,$packing_size);
    $available_qty=0;
    $check_the_qty=0;


    if($check_available==0)
    {
            $available_qty=check_qty($company_name,$product_name,$unit,$packing_size,$link);


            if($available_qty>=$qty)
            {
                $b=array("company_name"=>$company_name,"product_name"=>$product_name,"unit"=>$unit,"packing_size"=>$packing_size,"price"=>$price,"qty"=>$qty);
                array_push($_SESSION['cart'],$b);
            }
        else{
            echo "Entered qty is not available";
        }
    }
    else
    {
        $av_qty=0;
        $exist_qty=0;
        $exist_qty=check_the_qty($company_name,$product_name,$unit,$packing_size);

        $exist_qty=$exist_qty+$qty;

        $av_qty=check_qty($company_name,$product_name,$unit,$packing_size,$link);


        if($av_qty>=$exist_qty)
        {

            $check_product_no_session=check_product_no_session($company_name,$product_name,$unit,$packing_size);
            $b=array("company_name"=>$company_name,"product_name"=>$product_name,"unit"=>$unit,"packing_size"=>$packing_size,"price"=>$price,"qty"=>$exist_qty);
            $_SESSION['cart'][$check_product_no_session]=$b;
        }
        else
        {
            echo "Entered qty is not available";
        }

    }


}
else{
    $available_qty=check_qty($company_name,$product_name,$unit,$packing_size,$link);
    if($available_qty>=$qty)
    {
        $_SESSION['cart']=array(array("company_name"=>$company_name,"product_name"=>$product_name,"unit"=>$unit,"packing_size"=>$packing_size,"price"=>$price,"qty"=>$qty));
    }
    else
    {
        echo "Entered qty is not available";
    }
}



function check_qty($product_company,$product_name,$product_unit,$packing_size,$link)
{


    $product_qty=0;
    $res=mysqli_query($link,"select * from stock_master where product_company='$product_company' && product_name='$product_name' && product_unit='$product_unit' && packing_size='$packing_size'");
    while($row=mysqli_fetch_array($res))
    {
        $product_qty=$row["product_qty"];
    }

    return $product_qty;
}

function check_duplicate_product($product_company,$product_name,$product_unit,$packing_size)
{
    $found=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++)
    {

        if(isset($_SESSION['cart'][$i]))
        {
            $company_name_session="";
            $product_name_session="";
            $unit_session="";
            $packing_size_session="";

            foreach($_SESSION['cart'][$i] as $key => $val)
            {
                if($key=="company_name")
                {
                    $company_name_session=$val;
                }
                else if($key=="product_name")
                {
                    $product_name_session=$val;
                }
                else if($key=="unit")
                {
                    $unit_session=$val;
                }
                else if($key=="packing_size")
                {
                    $packing_size_session=$val;
                }
            }

            if($company_name_session==$product_company && $product_name_session==$product_name && $unit_session==$product_unit && $packing_size_session==$packing_size)
            {
                $found=$found+1;
            }

        }


    }

    return $found;

}

function check_the_qty($product_company,$product_name,$product_unit,$packing_size)
{
    $qty_found=0;
    $qty_session=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++)
    {
        $company_name_session="";
        $product_name_session="";
        $unit_session="";
        $packing_size_session="";

        if(isset($_SESSION['cart'][$i]))
        {
            foreach($_SESSION['cart'][$i] as $key => $val)
            {
                if($key=="company_name")
                {
                    $company_name_session=$val;
                }
                else if($key=="product_name")
                {
                    $product_name_session=$val;
                }
                else if($key=="unit")
                {
                    $unit_session=$val;
                }
                else if($key=="packing_size")
                {
                    $packing_size_session=$val;
                }
                else if($key=="qty")
                {
                    $qty_session=$val;
                }
            }

            if($company_name_session==$product_company && $product_name_session==$product_name && $unit_session==$product_unit && $packing_size_session==$packing_size)
            {
                $qty_found=$qty_session;
            }

        }


    }

    return $qty_found;

}

function check_product_no_session($product_company,$product_name,$product_unit,$packing_size)
{
    $recordno=0;
    $max=sizeof($_SESSION['cart']);
    for($i=0;$i<$max;$i++)
    {

        if(isset($_SESSION['cart'][$i]))
        {
            $company_name_session="";
            $product_name_session="";
            $unit_session="";
            $packing_size_session="";

            foreach($_SESSION['cart'][$i] as $key => $val)
            {
                if($key=="company_name")
                {
                    $company_name_session=$val;
                }
                else if($key=="product_name")
                {
                    $product_name_session=$val;
                }
                else if($key=="unit")
                {
                    $unit_session=$val;
                }
                else if($key=="packing_size")
                {
                    $packing_size_session=$val;
                }
            }

            if($company_name_session==$product_company && $product_name_session==$product_name && $unit_session==$product_unit && $packing_size_session==$packing_size)
            {
                $recordno=$i;
            }

        }


    }

    return $recordno;
}
?>