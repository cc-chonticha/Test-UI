<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<title></title>
</head>
<body>
	 <title>Form Table</title>
   <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Table</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        form, table {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        button, input, select {
            padding: 10px;
            width: 100%;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        button.cancel {
            background-color: white;
            color: black;
            border: 2px solid #ddd;
        }
        button.cancel:hover {
            background-color: #f1f1f1;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Editable Table</h1>
    <form id="userForm">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
        
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
            <option value="">Select...</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="unknow">Unknow</option>
        </select>
        
        <label for="score">Score:</label>
        <input type="number" name="score" id="score" min="0" max="100" required>
        
        <button type="submit">Submit</button>
        <button type="button" class="cancel">Cancel</button>
    </form>

    <table id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Score</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            function loadTableData() {
                $.ajax({
                    url: 'fetch_data.php',
                    type: 'GET',
                    success: function(response) {
                        $('#userTable tbody').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            loadTableData();

            $('#userForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                var editId = $(this).data('edit-id');
                if (editId) {
                    formData += '&id=' + editId;
                }

                $.ajax({
                    url: editId ? 'update_data.php' : 'process.php',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        loadTableData();
                        $('#userForm')[0].reset();
                        $('#userForm').removeData('edit-id');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error submitting form:', error);
                    }
                });
            });

            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var firstName = $(this).closest('tr').find('.first_name').text();
                var lastName = $(this).closest('tr').find('.last_name').text();
                var gender = $(this).closest('tr').find('.gender').text();
                var score = $(this).closest('tr').find('.score').text();

                $('#first_name').val(firstName);
                $('#last_name').val(lastName);
                $('#gender').val(gender.toLowerCase());
                $('#score').val(score);
                $('#userForm').data('edit-id', id);

                // เลื่อนหน้าไปที่ฟอร์ม
                $('html, body').animate({
                    scrollTop: $('#userForm').offset().top
                }, 500);
            });
        });
    </script>
</body>
</html>


</body>
</html>