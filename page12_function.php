<?php
//การสร้างฟังก์ชั่นขึ้นใช้งานเอง (user-Defind Function)

include("inc_function.php");


echo Calstock (" หมวก ",250,10);
echo Calstock (" หมวก 2 ",2000,3);
echo Calstock (" หมวก 3 ",20000,2);

echo"<br>";
$number = 70500.50;
$thai =Convert($number);
echo $thai;





?>
