<?php
session_start();
if ( ! isset($_SESSION['login_id']) Or $_SESSION['login_level'] !="Admin") 
{
    header("Refresh:1; url=login.php");
    exit();
}
include("../inc_connect.php"); // ../คือการออกจ้างนอก 1 ชั้น เนื่องจากหา ไม่เจอ



if (isset($_POST['submit']))
{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $position=$_POST['position'];
    $email=$_POST['email'];
    

    // //กรณีมีการอัปโหลดไฟล์
    // if ( isset($_FILES['sub_image']['name']) and  $_FILES['sub_image']['name'] != "" ) {

    //     $fname = $_FILES['sub_image']['name'];      //ชื่อไฟล์
    //     $fsize = $_FILES['sub_image']['size'];      //เก็บขนาดไฟล์
    //     $fdata = $_FILES['sub_image']['tmp_name'];  //เก็บไฟล์จริง
    //     $ftype =  mime_content_type($fdata);        //เก็บชนิดไฟล์

    //     if ($ftype != "image/jpeg" And $ftype != "image/png" ) //ป้องกันไฟล์ผิดประเภท
    //     {
    //         echo "<script> alert('ไฟล์ต้องเป็น jpg เท่านั้นครับ'); </script>";
    //         echo "<script> history.back(); </script>";
    //         exit();
    //     }

    //     if ($fsize > 102400)  //ป้องกันขนาดเกิน 100KB
    //     {
    //         echo "<script> alert('ไฟล์ต้องไม่เกิน 100KB เท่านั้นครับ'); </script>";
    //         echo "<script> history.back(); </script>";
    //         exit();
    //     }

    //     $fname = date("dmYHis")."_".$fname;//ป้องกันชื่อซ้ำ
    //     move_uploaded_file($fdata,"../img_subject/$fname"); //นำไฟล์ไปใส่โฟลเดอร์ที่ต้องการ
    //     $sub_image =$fname;

    // }


    $sql = " Insert Into subject ( sub_name,sub_detail,sub_image) values ('$id','$name','$surname','$position','$email' )"; //ดึงข้อมูลวิชาด้วยรหัสวิชา
    $rst = mysqli_query($conn,$sql);

    echo "<script> alert ('บันทึกข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<script> window.location='subject.php';</script>";
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>วิชา</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/mystyle.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</head>
<body>
    <?php include("inc_menu.php");?>

    <div class="container">
        
        <h3 class="float-start mb-3" >เพิ่มรายชื่อครู </h3>
        <form action="" method="post" enctype="multipart/form-data"><!-- ต้องใส่ทุกครั้ง <input type="file">-->
                <table class="table">
                    <tr>
                        <td>รหัส</td>
                        <td> <input type="text" name="id" id="id" class="form-control" require="true"> </td>
                    </tr>
                    <tr>
                        <td>ชื่อ</td>
                        <td> <input type="text" name="name" id="name" class="form-control" require="true"> </td>
                    </tr>
                    <tr>
                        <td>นามสกุล</td>
                        <td> <input type="text" name="sur_name" id="sur_name" class="form-control" require="true"> </td>
                    </tr><tr>
                        <td>ตำแหน่ง</td>
                        <td> <input type="selete" name="position" id="position" class="form-select" require="true"> </td>
                    </tr></tr><tr>
                        <td>email</td>
                        <td> <input type="text" name="email" id="email" class="form-control" require="true"> </td>
                    </tr>
                    </tr><tr>
                        <td>รหัสผ่าน</td>
                        <td> <input type="ืtext" name="password" id="password" class="form-control" require="true"> </td>
                    </tr>

                   
                    <tr>
                        <td></td>
                        <td> 
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> บันทึกข้อมูล </button>
                            <button type="button" class="btn btn-secondary" onclick="window.location='subject.php';"><i class="fa-solid fa-xmark"></i> ยกเลิก </button>
                        </td>

                    </tr>
                </table>
        </form>
           

          
      
    </div>
</body>
</html>
<?php mysqli_close($conn); 
  ?> 