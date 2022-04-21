<table class="table table-hover">
    <thead>
      <tr class="tableTR">
        <th>Sl.no</th>
        <th>Store ID</th>
        <th>Store Name</th>
        <th>Store Availability</th>
        <th>Total Book Stock</th>
        <th colspan="2" style="text-align: -webkit-center;">Operations</th>
      </tr>
    </thead>
    <tbody>
       <?php
       
            $i = 1;
            $ids = $_SESSION['User_id'];
            $sql6 = "SELECT * FROM `store` WHERE `UserId`='$ids';";
			$res6 = $conn->prepare($sql6);
			$res6->execute();
            $row = $res6->fetchAll();
            foreach ($row as $value){

                $stid = $value['StoreId'];

                $sql8 = "SELECT count(*) FROM `book` WHERE `storeId` = '$stid' GROUP BY `BookName`;";
                $res8 = $conn->prepare($sql8);
                $res8->execute();
                $count = $res8->rowcount();
                if( $count == 0){
                   $count = "<b  style='font-weight: 600;color: red'>No Books";
                }

                echo '<tr>
                <td>'.$i++.'</td>
                <td ><p style="white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;width: 335px;">'.$stid.'</p></td>
                <td>'.$value['StoreName'].'</td>
                <td style="font-weight: 600">'.$value['StoreStatus'].'</td>
                <td>'.$count.'</td>
                <td> <a href="updateStore.php?storeid='.$stid.'"><button class="btn btn-sm btn-primary"> UPDATE </button></a></td>';
                if($value['StoreStatus'] == "ACTIVE"){
                  echo '<td><a href="deleteStore.php?storeid='.$stid.'"><button class="btn btn-sm btn-danger"> DELETE </button></a></td>';
                }else{
                  echo '<td><a href="deleteStore.php?storeid='.$stid.'"><button class="btn btn-sm btn-warning"> RESTORE </button></a></td>';
                }
                  echo'</tr>';
            }
        ?>
      
    </tbody>
</table>