<table class="table table-hover">
    <thead>
      <tr class="tableTR">
        <th>Sl.no</th>
        <th>Book Name</th>
        <th>Book Category</th>
        <th>Book Description</th>
        <th>Book Price</th>
        <th>Book Availability</th>
        <th>Book Status</th>
        <th colspan="2" style="text-align: -webkit-center;">Operations</th>
      </tr>
    </thead>
    <tbody>
       <?php
       
            
            $categoryArray = catReturn();

            #print_r($categoryArray);
            $i = 1;
            $ids = $_SESSION['User_id'];
            $sql6 = "SELECT * FROM `book` WHERE `UserId`='$ids';";
			$res6 = $conn->prepare($sql6);
			$res6->execute();
            $row = $res6->fetchAll();
            foreach ($row as $value){
                $cat = $value['CatId'];
                if($value['BookAvailable'] != 0){
                    $noa = $value['BookAvailable'];
                }else{
                    $noa = "<b style='color: red; font-weight: 600;'>Out of stock</b>";
                }
                echo '<tr>
                <td>'.$i++.'</td>
                <td>'.$value['BookName'].'</td>
                <td>'.$categoryArray[$cat].'</td>
                <td ><p style="white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;width: 200px;">'.$value['BookDesc'].'</p></td>
                <td>'.$value['BookPrice'].'</td>
                <td>'.$noa.'</td>
                <td style="font-weight: 600">'.$value['BookStatus'].'</td>
                <td><a href="updatebook.php?bookid='.$value['BookId'].'"><button class="btn btn-sm btn-primary"> UPDATE </button></a></td>';
                if($value['BookStatus'] == "ACTIVE"){
                 echo' <td><a href="deleteBook.php?bookid='.$value['BookId'].'"><button class="btn btn-sm btn-danger"> DELETE </button></a></td>';
                }else{
                 echo '<td><a href="deleteBook.php?bookid='.$value['BookId'].'"><button class="btn btn-sm btn-warning"> RESTORE </button></a></td>';
                }
              echo'</tr>';
            }
        ?>
      
    </tbody>
</table>