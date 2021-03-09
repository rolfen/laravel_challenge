<!DOCTYPE html>
    <head>
        @include('head')
    </head>
   <body>
        <div id="edit">
            <h2><?= ($is_new ? "Add" : "Edit") ?> Book</h2>
            <a class="go-back" href="../">&lt; List</a>
            <form action="/edit/<?= $book['id'] ?>" method="post">
                 @csrf
                <input type="hidden" name="id" value="<?= $book['id'] ?>">                <input type="hidden" name="author_id" value="<?= $author['id'] ?>">
                <label>
                    Book Name
                    <input type="text" name="book-name" value="<?= $book['name'] ?>">        
                </label>
                <label>
                    Book Year
                    <input type="text" name="book-year" value="<?= $book['year'] ?>">
                </label>
                <label>
                    Author Name
                    <input type="text" name="author-name" value="<?= $author['name'] ?>">
                </label>
                <label>
                    Author Birth Date
                    <input type="text" name="author-birth-date" value="<?= $author['birth_date'] ?>">
                </label>
                <label>
                    Author Genre
                    <input type="text" name="author-genre" value="<?= $author['genre'] ?>">
                </label>
                <label>
                    Change Author
                    <select name="select-author">
                        <option value="current"> - Don't change - </option>
                        <option value="new"> - Create new - </option>
                        <?php foreach ($author_list as $author_id => $author_name) { ?>
                            <option 
                                <?= ($author_id == $author['id']) ? 'selected' : '' ?>
                                value="<?= $author_id ?>"
                            ><?= $author_name ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label>
                    Libraries
                    <select name="select-libraries[]" multiple>
                        <?php foreach ($library_list as $library_id => $library_name) { ?>
                            <option 
                                <?= in_array($library_id, $linked_libraries) ? 'selected' : '' ?>
                                value="<?= $library_id ?>"
                            ><?= $library_name ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label>
                    <!--
                    Create / Edit Library
                    <select name="edit-library">
                        <option>New Library</option>
                        <option>...</option>
                    </select>
                    -->
                </label>
                <label>
                    New Library Name
                    <input type="text" name="new-library-name" >
                </label>
                <label>
                    New Library Address
                    <input type="text" name="new-library-address" >
                </label>
                <div class="form_cta">
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </body>
</html>