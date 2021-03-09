<!DOCTYPE html>
    <head>
        @include('head')
    </head>
   <body>
        <div id="edit">
            <h2>Edit Book</h2>
            <form>
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
                    Change Author
                    <select>
                        <option>Select ...</option>
                        <?php foreach ($author_list as $author_id => $author_name) { ?>
                            <option value="<?= $author_id ?>"><?= $author_name ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label>
                    Libraries
                    <select name="select-libraries" multiple>
                        <?php foreach ($library_list as $library_id => $library_name) { ?>
                        <option value="<?= $library_id ?>"><?= $library_name ?></option>
                        <?php } ?>
                    </select>
                </label>
                <label>
                    Create / Edit Library
                    <select name="edit-library">
                        <option>New Library</option>
                        <option>...</option>
                    </select>
                </label>
                <label>
                    New Library Name
                    <input type="text" name="library-name" >
                </label>
                <label>
                    New Library Address
                    <input type="text" name="library-address" >
                </label>
                <div class="form_cta">
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </body>
</html>