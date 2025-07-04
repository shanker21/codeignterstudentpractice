<?php
// echo '<pre>';print_r($student);echo '</pre>';exit;

?>
<html>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        tr:nth-child(1) { background-color: gold; font-weight: bold; }
        tr:nth-child(2) { background-color:rgb(253, 0, 0);; font-weight: bold; }
        tr:nth-child(3) { background-color:rgb(246, 129, 13); font-weight: bold; } /* bronze */
        .hideform {
            display: none;
        }
        .center {
            margin: auto;
            width: 60%;
            padding: 20px;
            margin-top: 20px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }
        td, th {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
         h2 {
            text-align: center;
            margin-top: 20px;
        }
        a .link-success{
            color : green;
        }
    </style>
</head>
<body>
    <h2>Homepage</h2>
    <p style="text-align:center;">
        <a href="/add">Add New Data</a>
    </p>
    <div id="message"></div>
    <div class="container mt-4">
    <div class="row">
        <div class="col-12">
        <table id="studenttable" class="table table-bordered table-striped">
            <thead bgcolor="#DDDDDD">
            <tr>
                <td>Name</td>
                <td>Age</td>
                <td>Email</td>
                <td>Marks</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
  </div>
</div>
 
    <div class="container">
        
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                    <h4 class="modal-title" id="myModalLabel">Student Marks</h4> 
                </div> 
                <div class="modal-body"> 
                    <form method="post" id="marksform" action="<?= base_url('marks/submit') ?>">
                        <input type="hidden" name="id" id="student_id">
                        Telugu:<br>
                        <input type="text" name="telugu" id="telugu" required><br>
                        Hindi:<br>
                        <input type="text" name="hindi" id="hindi" required><br>
                        English:<br>
                        <input type="text" name="english" id="english" required><br>
                        Maths:<br>
                        <input type="text" name="maths" id="maths" required><br>
                        Science:<br>
                        <input type="text" name="science" id="science" required><br>
                        Social:<br>
                        <input type="text" name="social" id="social" required><br><br>
                        <input type="submit" class="btn btn-success" value="Add">
                    </form>        
                </div> 
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                </div> 
            </div> 
        </div>  
    </div> 
</div>

<script>
$(document).ready(function () {
    $('.openModal').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#student_id').val(id);

        // Replace this AJAX with your actual backend logic
        $.get("<?= base_url('listing/get_student_marks') ?>"+ id, { id: id }, function (data) {
            $('#telugu').val(data.telugu || '');
            $('#hindi').val(data.hindi || '');
            $('#english').val(data.english || '');
            $('#maths').val(data.maths || '');
            $('#science').val(data.science || '');
            $('#social').val(data.social || '');
            if (data && (data.telugu || data.hindi || data.english || data.maths || data.science || data.social)) {
            $("#marksform input[type=submit]").val("Update marks");
        } else {
            // No marks found, set button text to "Add"
            $("#marksform input[type=submit]").val("Add marks");
        }
            $('#myModal').modal('show');
        });
    });

    $("#marksform").submit(function(e){
        console.log("submit");
        e.preventDefault();
        dataString = $("#marksform").serialize();
        $.ajax({
            type: "POST",
            url: "<?= base_url('listing/contact') ?>",
            data: dataString,
            dataType: 'json',
            success: function(response){
                console.log(response);
                // alert('Successful!');
                $("#result").html('Successfully updated record!'); 
                $("#result").addClass("alert alert-success");
                // Hide the modal (Bootstrap 4/5)
                $('#myModal').modal('hide');
            }

        });
        return false;  //stop the actual form post !important!

    });
         $.ajax({
            url: "<?= base_url('listing/index') ?>",
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Student Data:", data);
                ('#studenttable tbody').empty();
                 data.forEach(function(student) {
                     $('studenttable tbody').append(
                        `
                            <tr>
                            <td>${student.name}</td>
                            <td>${student.age}</td>
                            <td>${student.email}</td>
                            </tr>
                        `
                    )
                     
                })
                
                // You can now loop through or use the data
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
});
</script>