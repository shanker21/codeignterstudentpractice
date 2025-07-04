<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h4 class="text-primary">Edit Student Data</h4>
    <p>
        <a href="/studentlist" class="btn btn-default" id="button">Home</a>
    </p>
    <div id="message"></div>
    <form id="editForm" action="" method="POST">
        <input type="hidden" class="id" id="id" value ="<?php echo htmlspecialchars($student['id']); ?>">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="<?php echo htmlspecialchars($student['name']); ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="age" class="col-sm-2 control-label">Age</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="age" id="age" placeholder="Enter age" value="<?php echo htmlspecialchars($student['age']); ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo htmlspecialchars($student['email']); ?>" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input type="submit" name="submit" class="btn btn-primary" value="update">
            </div>
        </div>
    </form>
</div>
<script>
    $('#editForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading page
        const id = $('#id').val();
        console.log('id',id);
        $.ajax({
            url: "<?= base_url('student/update/') ?>" +id,
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    $('#message').html(`<span style="color: green;">${response.message}</span>`);
                    window.location.href = '/studentlist';
                } else {
                    $('#message').html(`<span style="color: red;">${response.message}</span>`);
                }
            },
            error: function() {
                $('#message').html('<span style="color: red;">Something went wrong.</span>');
            }
        });
    });
</script>
</script>
</body>
</html>
