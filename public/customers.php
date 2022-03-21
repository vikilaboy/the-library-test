<?php

$items = Customer::getAll();
?>
<div class="float-left">
    <h1>Clienti</h1>
</div>
<div class="float-right">
    <a href="?page=customers&action=new" class="btn btn-primary"><i class="ion-plus-round"></i>&nbsp;Client nou</a>
</div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Nume</th>
        <th>Actiuni</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($items as $item) {
        ?>
        <tr>
            <th scope="row"><?php echo $item->id ?></th>
            <td><a href="?page=<?php echo $page?>&action=edit&id=<?php echo $item->id ?>"><?php echo $item->name ?></a></td>
            <td>
                <a href="?page=<?php echo $page?>&action=edit&id=<?php echo $item->id ?>"><i class="ion-edit"></i></a>
                &nbsp;&nbsp;
                <a href="?page=<?php echo $page?>&action=delete&id=<?php echo $item->id ?>" onclick="return confirm('Confirmati stergerea?')"><i class="ion-trash-b"></i></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

