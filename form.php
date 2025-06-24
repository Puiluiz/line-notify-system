<?php
echo '<form method="post" action="add.php">
  Email: <input type="email" name="email" required><br>
  วันที่สมัคร: <input type="date" name="start_date" required><br>
  แพ็คเกจ: 
  <select name="package">
    <option value="1">1 เดือน</option>
    <option value="2">2 เดือน</option>
    <option value="3">3 เดือน</option>
  </select><br>
  หัวแฟม: <input type="text" name="family_name"><br>
  LINE userId: <input type="text" name="line_user_id" required><br>
  <input type="submit" value="เพิ่มข้อมูลลูกค้า">
</form>';
