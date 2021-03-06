<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
  
 <link rel ="icon" href="../../img/logo.png">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>DIVISION OFFICE</title>
  	<!-- Tell the browser to be responsive to screen width --> 
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.7 -->
  	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  	<!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->

  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel= "stylesheet" href= "../../css/admin-modal.css" type= "text/css">

  	<style type="text/css">
  		.mt20{
  			margin-top:20px;
  		}
      .bold{
        font-weight:bold;
      }

     /* chart style*/
      #legend ul {
        list-style: none;
      }

      #legend ul li {
        display: inline;
        padding-left: 30px;
        position: relative;
        margin-bottom: 4px;
        border-radius: 5px;
        padding: 2px 8px 2px 28px;
        font-size: 14px;
        cursor: default;
        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;
      }

      #legend li span {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
        border-radius: 5px;
      }
      #retrieve {
        
      }
            
      /* message box */

      .message{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,.4);
        /* border: 1px solid red; */
        z-index: 1000;
      }
      .message-inner{
          width: 100%;
          height: 100%;
          position: relative;
      }
      .message-box{
          width: 100%;
          height: 30%;
          position: absolute;
          top: 35%;
          left: 0;
          background-color: #fff;
      }
      .message-box-icon{
          width: 100%;
          height: calc(40% - 24px);
          padding: 12px 0px;
          text-align: center;
      }
      .message-box-icon i{
          font-size: 4.4em;
          color: #cc1f1f;
      }
      .message-box-message{
          width: 100%;
          height: calc(35% - 24px);
          padding: 12px 0px;
          text-align: center;
          font-size: 2em;
      }
      .message-box-btn{
          width: 100%;
          height: calc(25% - 16px);
          padding: 8px 0px;
          text-align: center;
      }
      .message-box-btn button{
          width: calc(10% - 8px);
          height: 100%;
          border: 2px solid rgb(4, 80, 140);
          font-size: 1em;
          background-color: #fff;
          color: rgb(4, 80, 140);
          border-radius: 8px;
          cursor: pointer;
          outline: none;
          margin: 0px 4px;
          font-weight: bold;
      }
      .logout-yes{
          background-color: rgb(4,80,140) !important;
          color: #fff !important;
      }
  	</style>
    <script>
  $(function(){
  $("#admin_save").click(function(){
  var user = $("#username").val();
  var pass = $("#password").val();
  var fn = $("#firstname").val();
  var ln = $("#lastname").val();
  var cpass = $("#curr_password").val();
  var admin_pass = $("#admin_pass").val();
  var id = $("#admin_id").val();



      var file_data = $('#photo').prop('files')[0];         
      var form_data = new FormData();
       form_data.append('file',file_data);

        $.ajax({
                    url:'../credentials/admin_img_upload.php',
                    dataType:'text',
                    cache:false,
                    contentType:false,
                    processData:false,
                    data:form_data,
                    type:'post'
                }).done(function(output_img){
                    // alert(output_img);
                      $.ajax({
                         type: 'POST',
                            url: '../credentials/model.php',
                            data: {action:'edit_admin', id:id, ln:ln, fn:fn, user:user, pass:pass,img:output_img},
                            dataType: 'json',
                              success: function(response){
                              if(response.confirm==='success'){
                                      alert("Update Success!");
                                       $("#profile").modal("hide");

                              }else{
                                      alert('e');
                                  }
          
                            }
                     });
                            
                });
    /*
    $.ajax({
        type: 'POST',
        url: '../credentials/model.php',
        data: {action:'edit_admin', id:id, ln:ln, fn:fn, user:user, pass:pass},
        dataType: 'json',
        success: function(response){
          if(response.confirm==='success'){
            alert("Update Success!");
            $("#profile").modal("hide");

          }else{
            alert('e');
          }
          
        }
      });
      */
   




});
 $( "#firstname" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
 $( "#lastname" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                });
});

    </script>
</head>