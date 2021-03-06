<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    $('#expiration').attr('min', maxDate);
});
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#edit_expiration').attr('min', maxDate);
});
</script>
  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PUBLISH VACANCY
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Publish Vacancy</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      
            <div style="display: none;" class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
           
            </div>
       
            <div style="display: none;" class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
             
            </div>
        
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-body" id="reload">
              <table id="example1" class="table-bordered">
                <thead>
                 
                  <th>TITLE</th>
                  <th>DESCRIPTION</th>
                  <th>NAME OF INCUMBENT</th>
                  <th>PLACE ASSIGNMENT</th>
                  <th>PUBLICATION DATE</th>
                  <th>EXPIRATION DATE</th>
                  <th>STATUS</th>
                  <th>SALARIES</th>
                  <th>ITEM NO</th>
                  <th>TOOLS</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM publish_vacancy WHERE isActive = '1' and APP_ISSET = '0'";



                    
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                                
                     if(strtotime($row['PUBLICATION_DATE']) > strtotime($row['PUBLICATION_DATE_UNTIL'])) {
                                $status='<span class="label label-danger pull-right">Expired</span>';
                            }
                            else{
                                  $status='<span class="label label-success pull-right">Ongoing</span>';
                            }
                            
                      echo "
                        <tr>
                        
                          <td>".$row['TITLE']."</td>
                          <td>".$row['DESCRIPTION']."</td>
                          <td>".$row['NOI']."</td>
                          <td>".$row['PLACE_ASSIGNMENT']."</td>
                          <td>".$row['PUBLICATION_DATE']."</td>
                          <td>".$row['PUBLICATION_DATE_UNTIL']."</td>
                          <td>".$row['STATUS'].' '.$status."</td>
                          <td>".$row['SALARIES']."</td>
                          <td>".$row['ITEM_NO']."</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['UID']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['UID']."'><i class='fa fa-archive'></i> Archive</button>
                          </td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/publish_vacancy_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>

$(function(){
  
   $(".edit").click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    $("#id").val(id);
   $.ajax({
    type: 'POST',
    url: '../credentials/model.php',
    data: {action:'get_vacancy_id',id:id},
    dataType: 'json',
    success: function(response){
     
      
       
       $('#edit_title').val(response.title);
       $('#edit_expiration').val(response.expiration);
       $('#edit_description').val(response.description);
       $('#edit_noi').val(response.noi);
        $('#edit_status').val(response.status);
       $('#edit_itemno').val(response.itemno);
       $('#edit_salaries').val(response.salaries);
       $('#edit_place').val(response.place);
     


    
    }
  });
  });
                       /* EDIT BUTTON */
            $("#edit_vacancy").click(function(e){
            e.preventDefault();
            var edit_id = $("#id").val();
            var title = $("#edit_title").val();
            var expi_date = $("#edit_expiration").val();
            var desc = $("#edit_description").val();
            var noi = $("#edit_noi").val();
            var place = $("#edit_place").val();
            var status = $("#edit_status").val();
            var salaries = $("#edit_salaries").val();
            var itemno = $("#edit_itemno").val();
            if(title == "" || desc == "" || noi == "" || salaries == "" || itemno == ""){
                alert("Fill up all forms!");
            }
            else{
            $.ajax({
            type: 'POST',
            url: '../credentials/model.php',
            data: {action:'edit_vacancy',edit_id:edit_id, title:title, expi_date:expi_date,
              desc:desc, noi:noi, place:place, status:status, salaries:salaries, itemno:itemno},
            dataType: 'json',
            success: function(response){
              alert(response.message);
              $('.alert-success').css("display","block").html(response.message);
              $('#edit').modal('hide');
              $("#reload").load(location.href + " #reload>*", "");
      
       
     


    
    }
  });
            }


            });













          /*GET DELETE  ID*/
  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    $("#delete_id").val(id);
  });

  /*  ARCHIVE BUTTON*/
  $("#delete_vacancy").click(function(e){
    e.preventDefault();
    var id = $("#delete_id").val();

      $.ajax({
    type: 'POST',
    url: '../credentials/model.php',
    data: {action:'archive_vacancy',id:id},
    dataType: 'json',
    success: function(response){
      alert(response.message);
             $('.alert-success').css("display","block").html(response.message);
           $('#delete').modal('hide');
        $("#reload").load(location.href + " #reload>*", "");
      
    }
  });



  });


$( "#itemno ").keydown(function  (e){
    var itemno = $("#itemno").val();
    var qwe = $("#itemno").val().length;
    if(qwe == 4 || qwe == 10){
    var s = itemno + "-";
    $("#itemno").val(s);
    }
});


 $( "#title" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
 $( "#edit_title" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });


 $( "#noi" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
  $( "#edit_noi" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
 $("#salaries").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
    
               return false;
    }
   });
 $("#edit_salaries").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
     
               return false;
    }
   });


    $('#submit_vacancy').click(function(e){
    e.preventDefault();
        var title = $('#title').val();
        var expiration = $('#expiration').val();
        var description = $('#description').val();
        var noi = $('#noi').val();
        var status = $('#status').val();
        var itemno = $('#itemno').val();
        var salaries = $('#salaries').val();
         var place = $('#place').val();
        if(title = "" || description == "" || noi == "" || itemno == "" || salaries =="")
        {
          alert("Fill up all forms!");
        }
        else{
        add_vacancy();
   }
 
  });
     $('#close').click(function(e){
   $('#addnew').modal('hide');
                   $("#title").val("");
                   $("#expiration").val("");
                   $("#description").val("");
                   $("#noi").val("");
                   $("#status").val("");
                   $("#itemno").val("");
                   $("#salaries").val("");
                   $("#place").val("");
  });
});



function add_vacancy(action='add_vacancy'){

        var title = $('#title').val();
        var expiration = $('#expiration').val();
        var description = $('#description').val();
        var noi = $('#noi').val();
        var status = $('#status').val();
        var itemno = $('#itemno').val();
        var salaries = $('#salaries').val();
         var place = $('#place').val();


  $.ajax({
    type: 'POST',
    url: '../credentials/model.php',
    data: {action:action,title:title,description:description,noi:noi,status:status,itemno:itemno,salaries:salaries,place:place,expiration:expiration},
    dataType: 'json',
    success: function(response){

               alert(response.message);
                 $('.alert-success').css("display","block").html(response.message);
                   $('#addnew').modal('hide');
                   $("#title").val("");
                   $("#expiration").val("");
                   $("#description").val("");
                   $("#noi").val("");
                   $("#status").val("");
                   $("#itemno").val("");
                   $("#salaries").val("");
                   $("#place").val("");

        $("#reload").load(location.href + " #reload>*", "");
      

    }
  });
}
</script>
</body>
</html>
