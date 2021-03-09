<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('head')
    </head>
   <body>
        <div>
            <h2>All Books</h2>

            <button class="align-right">Add Book</button>
            <table>
                <thead>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <!--
                    <th>Library</th>
                    <th>Address</th>
                    -->
                    <th>Actions</th>
                </thead>

                <tbody>
                    <?php foreach ($books as $book) { ?>
                        <tr>
                            <td><?= $book['name'] ?></td>
                            <td><?= $book['year'] ?></td>
                            <td><?= $book['author']['name'] ?></td>
                            <td><?= $book['author']['genre'] ?></td>
                            <!--
                            <td></td>
                            <td></td>
                            -->
                            <td>
                                <a href="./edit/<?= $book['id'] ?>">Edit</a>
                                <a href="./delete/<?= $book['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </div>
    </body>
</html>
