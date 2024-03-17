<!-- LOGO -->
<div class="logo-box">
    <a href="index.php" class="logo text-center">
        <span class="logo-lg">
            <?$sqlL = $cn->selectdb("select * from tbl_logo where logo_id= 1 ");
                $rowL = mysqli_fetch_assoc($sqlL);
            ?>
                <img src="<?if($rowL['image_name']!=''){echo "../logo/big_img/".$rowL['image_name'];}?>" style="width:200px;" alt="">
        </span>
    </a>
</div>