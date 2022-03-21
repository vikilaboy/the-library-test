<?php

if (null === getValue('action') || getValue('action') == 'list' || getValue('action') == 'index') {
    $items = Author::getAll();

    ?>
    <div class="float-left">
        <h1>Autori</h1>
    </div>
    <div class="float-right">
        <a href="?page=authors&action=new" class="btn btn-primary"><i class="ion-plus-round"></i>&nbsp;Autor nou</a>
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
                <td><a href="?page=<?php echo $page ?>&action=edit&id=<?php echo $item->id ?>"><?php echo $item->name ?></a></td>
                <td>
                    <a href="?page=<?php echo $page ?>&action=edit&id=<?php echo $item->id ?>"><i class="ion-edit"></i></a>
                    &nbsp;&nbsp;
                    <a href="?page=<?php echo $page ?>&action=delete&id=<?php echo $item->id ?>"
                       onclick="return confirm('Confirmati stergerea?')"><i class="ion-trash-b"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}

if (getValue('action') == 'edit' && is_numeric(getValue('id'))) {
    $author = Author::getById(getValue('id'));

    if (!$author) {
        flash('Author not found', 'danger');

        redirect('?page=authors');
    }
}

if (getValue('action') == 'delete' && is_numeric(getValue('id'))) {
    if (Author::deleteById(getValue('id'))) {
        flash('Author deleted with success', 'success');
    } else {
        flash('Author was not deleted', 'danger');
    }

    redirect('?page=authors');
}

if (getValue('action') == 'new' || getValue('action') == 'edit') {
    ?>
    <a href="?page=<?php echo $page ?>"><h1>Autori</h1></a>

    <form method="post">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nume</label>
            <input type="hidden" name="id" value="<?php echo isset($author) ? $author->id : '' ?>">
            <div class="col-sm-10">
                <input type="text"
                       class="form-control"
                       id="name"
                       placeholder="Nume"
                       name="name"
                       value="<?php echo isset($author) ? $author->name : (isset($_POST['name']) ? $_POST['name'] : '') ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Salveaza</button>
    </form>
    <?php
}

if (isset($_POST['submit'])) {

    $params = [];
    $author = new Author();

    if (!empty($_POST['id'])) {
        $author = Author::getById($_POST['id']);
        if (!$author) {
            flash('Author not found on save', 'danger');

            redirect('?page=authors');
        }
    }

    if (!$author->save($_POST)) {
        flash('Author not saved', 'danger');
    } else {
        flash('Author saved', 'success');
    }

    redirect('?page=authors');

}
