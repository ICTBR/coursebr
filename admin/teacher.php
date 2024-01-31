<?php
session_start();
if ( ! isset($_SESSION['login_id']) Or $_SESSION['login_level'] !="Admin") 
{
    header("Refresh:1; url=login.php");
    exit();
}
include("../inc_connect.php"); // ../คือการออกจ้างนอก 1 ชั้น เนื่องจากหา ไม่เจอ

if (isset($_GET['id']) AND $_GET['id']!= "")
{
    $sub_id=$_GET['id'];
    $sql = " Delete From teacher Where id = $id "; //ดึงข้อมูลวิชาด้วยรหัสวิชา
    $rst = mysqli_query($conn,$sql);

    echo "<script> alert ('ลบข้อมูลเรียบร้อยแล้ว');</script>";
    echo "<script> window.location='subject.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>คุณครู</title>
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
        <div style="margin:auto;width:85%;"> 
            <h3 class="float-start mb-3" >รายชื่อครู </h3>

            <form action = "" method = "post"><button type ="button" class="btn btn-success float-end mb-3 ms-3" onclick="window.location='teacher_insert.php';"> <i class="fa-solid fa-circle-plus"></i> เพิ่มรายชื่อครู </button>
                <button type ="submit" class="btn btn-primary float-end mb-3"> <i class="fa-solid fa-magnifying-glass"></i> ค้นหา </button>
                <input type="text" name="keyword" class="form-control w-25 float-end mb-3">  
            </form>

            <table class ="table table-sm">
           
                <tr class ="table-primary text-center">
                    <td> รหัส </td> 
                    <td> ชื่อ นามสกุล </td>  
                    <!-- <td> เพศ </td>  -->
                    <!-- <td> วันเกิด </td>  -->
                    <td> อีเมล </td>  
                    <td> ตำแหน่ง </td> 
                    <!-- <td> เงินเดือน </td> -->
                    <td> ... </td>
                </tr>
                <?php
                $sql = "Select * From teacher";

                if(isset($_POST['keyword']))
                {
                        $keyword = trim($_POST['keyword']);
                        $sql.=" where id like '%$keyword%' 
                        or name like '%$keyword%' 
                        or surname like '%$keyword%' 
                        or gender like '%$keyword%' 
                        or position like '%$keyword%'";

                }

                $rst = mysqli_query( $conn,$sql);
                $num = mysqli_num_rows($rst); // count rows
                while ($arr = mysqli_fetch_array($rst))
                {
                    // $d = explode ("-", $arr ['birthdate']);
                    // $birthdate =$d[2]."/".$d[1]."/".($d[0]+543);
                ?>
                <tr class ="text-center"> 
                    <td> <?php echo $arr ['id'];?> </td>  
                    <td> <?php echo $arr ['name']." ".$arr ['surname'];?> </td>  
                    <!-- <td> <?php echo $arr ['gender'];?> </td>   -->
                    <!-- <td> <?php echo $birthdate;?> </td>     -->
                    <td> <?php echo $arr ['email'];?> </td>  
                    <td> <?php echo $arr ['position'];?> </td>  
                    <!-- <td> <?php echo number_format( $arr['salary'],2);?> </td>   -->
                    <td>
                        <a href ="teacher_detail.php?id=<?php echo $arr ['id'];?>" title="รายละเอียด"><i class="fa-solid fa-eye" style="color: #c33e1d;"></i></a>
                        <a href ="#" title="แก้ไข"><i class="fa-solid fa-pencil"></i></a>
                        <a href ="teacher.php?id=<?php echo $arr ['id'];?>" title="ลบ" 
                        onclick="if (!confirm('ลบรายการเดี๋ยวนี้ ?')) return false;"><i class="fa-solid fa-trash"></i></a>
                    </td>               
                </tr>
                <?php
                }
                ?>
                <table>

                <p class ="text-center small"> ทั้งหมด <?php echo $num ?> รายการ </p>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); 
  ?> 