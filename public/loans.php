<?php

$items = Loan::getAll();

?>
<div class="float-left">
    <h1>Imprumuturi</h1>
</div>
<div class="float-right">
    <a href="?page=loans&action=new" class="btn btn-primary"><i class="ion-plus-round"></i>&nbsp;Imprumut nou</a>
</div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Nume</th>
        <th>Carte</th>
        <th>Data imprumut</th>
        <th>Data retur</th>
        <th>Actiuni</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($items as $item) {
        ?>
        <tr>
            <th scope="row"><?php echo $item->id ?></th>
            <td><a href="?page=customers&action=edit&id=<?php echo $item->id ?>"><?php echo $item->customer ?></a></td>
            <td><a href="?page=books&action=edit&id=<?php echo $item->book_id ?>"><?php echo $item->book ?></a></td>
            <td><?php echo $item->borrowed_at ?></td>
            <td><?php echo $item->returned_at ?></td>
            <td>
                <a href="?page=<?php echo $page?>&action=edit&id=<?php echo $item->id ?>"><i class="ion-edit"></i></a>
                &nbsp;&nbsp;
                <a href="?page=<?php echo $page?>&action=delete&id=<?php echo $item->id ?>"><i class="ion-trash-b"></i></a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

