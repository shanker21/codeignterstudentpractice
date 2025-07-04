<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        #button{
            
        }
    </style>
</head>
<body>
<div class="container">
    <h4 class="text-primary">Student Data</h4>
    <p>
        <a href="/studentlist" class="btn btn-default" id="button">Home</a>
    </p>
    <div id="message"></div>
    <form method="post" id="addForm" class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label for="age" class="col-sm-2 control-label">Age</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="age" id="age" placeholder="Enter age">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input type="submit" name="submit" class="btn btn-primary" value="Add">
            </div>
        </div>
    </form>
</div>
<script>
    $('#addForm').on('submit', function(e) {
        e.preventDefault(); // Prevent form from reloading page
        $.ajax({
            url: "<?= base_url('submitDetails') ?>",
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
</body>
</html>
