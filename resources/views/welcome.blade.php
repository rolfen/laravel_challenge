<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
            label {
                display: block;
            }
        </style>
    </head>
    <body class="antialiased">
        <div>
            <h2>All Books</h2>

            <button class="align-right">Add Book</button>
            <table>
                <thead>
                    <th>Book Name</th>
                    <th>Book Year</th>
                    <th>Author Name</th>
                    <th>Author Genre</th>
                    <th>Library Name</th>
                    <th>Library Address</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button>Edit</button>
                            <button>Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div>
            <h2>Book / Author (new/edit)</h2>
            <form>
                <label>
                    Book Name
                    <input type="text" name="book-name">        
                </label>
                <label>
                    Book Year
                    <input type="text" name="book-year">
                </label>
                <label>
                    Author
                    <select>
                        <option>New Author</option>
                        <option>...</option>
                    </select>
                </label>
                <label>
                    Author Name
                    <input type="text" name="author-name">
                </label>
                <label>
                    Author Birth Date
                    <input type="text" name="author-birth-date">
                </label>
                <label>
                    Author Year
                    <input type="text" name="author-year">
                </label>
                <label>
                    Libraries
                    <select name="select-libraries" multiple>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
                        <option value=""></option>
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
                    Library Name
                    <input type="text" name="library-name">
                </label>
                <label>
                    Library Address
                    <input type="text" name="library-address">
                </label>
            </form>
        </div>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
