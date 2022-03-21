<?php

if (null === getValue('action') || getValue('action') == 'list' || getValue('action') == 'index') {
    $items = Book::getAll();
    ?>
    <div class="float-left">
        <h1>Carti</h1>
    </div>
    <div class="float-right">
        <a href="?page=books&action=new" class="btn btn-primary"><i class="ion-plus-round"></i>&nbsp;Carte noua</a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Autori</th>
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
                <td><?php echo $item->authors ?></td>
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
    $item = Book::getById(getValue('id'));
    if (!$item) {
        flash('Book not found', 'danger');

        redirect('?page=books');
    }
}

if (getValue('action') == 'new' || getValue('action') == 'edit') {
    $authors = Author::getAll();
    ?>
    <a href="?page=<?php echo $page ?>"><h1>Carti</h1></a>

    <form method="post">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Nume</label>
            <input type="hidden" name="id" value="<?php echo isset($item) ? $item->id : '' ?>">
            <div class="col-sm-10">
                <input type="text"
                       class="form-control"
                       id="name"
                       placeholder="Nume"
                       name="name"
                       value="<?php echo isset($item) ? $item->name : (isset($_POST['name']) ? $_POST['name'] : '') ?>">
            </div>
        </div>

        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Autori</label>
            <div class="col-sm-10">
                <select name="authors[]" class="form-control" multiple="multiple">
                    <?php
                    foreach ($authors as $author) {
                        echo '<option value="' . $author->id . '" ' . (isset($item) && in_array($author->id,
                                $item->getAuthors(true)) ? 'selected="selected"' : '') . '>' . $author->name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" name="submit">Salveaza</button>
    </form>
    <?php
}

