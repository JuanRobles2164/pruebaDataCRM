<?php
require_once('../controllers/MainController.php');
$controller = new MainController;
$controller->getLogin([
    'operation' => $_GET['operation'],
    'username' => $_GET['username']
]);
$rows = $controller->execQuery();
?>
<br>
<table class="table ">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Contact #</th>
            <th>Lastname</th>
            <th>CreatedTime</th>
        </tr>
    </thead>
    <tbody id="tb_usuario">
            <?php
                foreach($rows as $key){
                    echo '<tr>';
                        echo '<td>'.$key['id'].'</td>';
                        echo '<td>'.$key['contact_no'].'</td>';
                        echo '<td>'.$key['lastname'].'</td>';
                        echo '<td>'.$key['createdtime'].'</td>';
                    echo '</tr>';
                }
            ?>
    </tbody>
</table>
