<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
    <div class="container">
      <div class="mt-4">
        {{-- <div class="row"> --}}
          <h4 class="text-center mb-4">AJAX CRUD OPERATION</h4>
        {{-- </div> --}}
        <div class="row">
          <div class="col-sm-8">
            <div class="card">
              <div class="card-header">
                <h6>All Data</h6>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">Action</th>
                      <th scope="col">Id</th>
                      <th scope="col">Name</th>
                      <th scope="col">Title</th>
                      <th scope="col">Institute</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr> --}}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card">
              <div class="card-header">
                <span id="addInfo">Add New Information</span>
                <span id="updateInfo">Update Information</span>
              </div>
              <div class="card-body">
                {{-- <form id="form_submit" method="post">
                  @csrf --}}
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="teachers_name" placeholder="Enter name">
                    <span class="text-danger" id="teachers_name_error"></span>
                  </div>
                  <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" id="teachers_title" placeholder="Enter title">
                    <span class="text-danger" id="teachers_title_error"></span>
                  </div>
                  <div class="form-group">
                    <label for="institute">Institute</label>
                    <input type="text" class="form-control" id="teachers_institute" placeholder="Enter institute">
                    <span class="text-danger" id="teachers_institute_error"></span>
                  </div>
                  <input type="hidden" id="teachers_id">
                  <button type="submit" class="btn btn-primary" id="addButton" onclick="addData()">Add</button>
                  <button type="submit" class="btn btn-primary" id="updateButton" onclick="updateData()">Update</button>
                {{-- </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      // $(document).ready(function(){
        $("#addButton").show();
        $("#updateButton").hide();
        $("#addInfo").show();
        $("#updateInfo").hide();

        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })

        function allData(){
          $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{url('/read')}}",
            success: function(response){
              let data = "";
              $.each(response, function(key, value){
                // console.log(value);
                data = data + "<tr>"
                  data = data + "<td>"
                    data = data + "<button class='btn btn-primary mr-2' onclick='editData("+ value.teachers_id +")' >Edit</button>"
                    data = data + "<button class='btn btn-danger' onclick='deleteData("+ value.teachers_id +")'>Delete</button>"
                  data = data + "</td>"
                  data = data + "<td>"+ value.teachers_id +"</td>"
                  data = data + "<td>"+ value.teachers_name +"</td>"
                  data = data + "<td>"+ value.teachers_title +"</td>"
                  data = data + "<td>"+ value.teachers_institute +"</td>"
                data = data + "</tr>"
              });
              $("tbody").html(data);
            }
          })
        }
        // onclick='editData("+ value.teachers_id +")'
        allData();

        function clearData(){
          $("#teachers_name").val("");
          $("#teachers_title").val("");
          $("#teachers_institute").val("");
          $("#teachers_name_error").text("");
          $("#teachers_title_error").text("");
          $("#teachers_institute_error").text("");
        }

        //------------------insert Data---------------

        function addData(){
        let teachers_name = $("#teachers_name").val();
        let teachers_title = $("#teachers_title").val();
        let teachers_institute = $("#teachers_institute").val();
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{url('/create')}}",
          data: {teachers_name:teachers_name, teachers_title:teachers_title, teachers_institute:teachers_institute},
          success: function(response){
            clearData();
            allData();
         
            const Msg = Swal.mixin({
              toast: true,
              position: 'top-end',
              icon: 'success',
              showConfirmButton: false,
              timer: 2000
            })
            Msg.fire({
              type: 'success',
              title: 'Data Insert Successfully',
            })
            // console.log("successfully Data added");
          },
          error: function(error){
            $("#teachers_name_error").text(error.responseJSON.errors.teachers_name);
            $("#teachers_title_error").text(error.responseJSON.errors.teachers_title);
            $("#teachers_institute_error").text(error.responseJSON.errors.teachers_institute);
          }
        })
      }

      //---------------------- Edit Data Start ------------------------

      function editData(teachers_id){
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "/find/"+teachers_id,
          success: function(response){
            $("#addButton").hide();
            $("#updateButton").show();
            $("#addInfo").hide();
            $("#updateInfo").show();

            $("#teachers_name").val(response.teachers_name);
            $("#teachers_id").val(response.teachers_id);
            $("#teachers_title").val(response.teachers_title);
            $("#teachers_institute").val(response.teachers_institute);
          }
        })
      }

      //---------------------- Update Data Start ------------------------
      
      function updateData(){
        // console.log('update');
        let teachers_id = $("#teachers_id").val();
        let teachers_name = $("#teachers_name").val();
        let teachers_title = $("#teachers_title").val();
        let teachers_institute = $("#teachers_institute").val();
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "/update/"+teachers_id,
          data: {teachers_name:teachers_name, teachers_title:teachers_title, teachers_institute:teachers_institute},
          success: function(response){
                  const Msg = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  Msg.fire({
                    type: 'success',
                    title: 'Data Update Successfully',
                  })
            $("#addButton").show();
            $("#updateButton").hide();
            $("#addInfo").show();
            $("#updateInfo").hide();
            clearData();
            allData();
            console.log("Data Updated Successfull");
          },
          error: function(error){
            // console.log(error);
            $("#teachers_name_error").text(error.responseJSON.errors.teachers_name);
            $("#teachers_title_error").text(error.responseJSON.errors.teachers_title);
            $("#teachers_institute_error").text(error.responseJSON.errors.teachers_institute);
          }
        })
      }

      //---------------------- Delete Data Start ------------------------

      function deleteData(teachers_id){
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              $.ajax({
                type: "GET",
                url: "/delete/"+teachers_id,
                success: function(response){
                  const Msg = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                  })
                  Msg.fire({
                    type: 'success',
                    title: 'Data Delete Successfully',
                  })
                  allData();
                }
              })
            )
          }
        })
        // $.ajax({
        //   type: "GET",
        //   url: "/delete/"+teachers_id,
        //   success: function(response){
        //     allData();
        //     console.log('data delete');
        //   }
        // })
      }

      // })

      //---------------------- Work End ------------------------

    </script>



    {{-- <script>
      // $(document).ready(function(){
       function editData(teachers_id){
          // console.log(teachers_id);
          $.ajax({
            type: "GET",
            dataType: "json",
            url: "/find/"+teachers_id,
            success: function(response){
              $("#addButton").hide();
              $("#updateButton").show();
              $("#addInfo").hide();
              $("#updateInfo").show();

              $("#teachers_name").val(response.teachers_name);
              $("#teachers_title").val(response.teachers_title);
              $("#teachers_institute").val(response.teachers_institute);
            }
          })
        }
      // })
    </script> --}}


    {{-- <script>
      function updateData(){
        console.log('update');
        // let teachers_name = $("#teachers_name").val();
        // let teachers_title = $("#teachers_title").val();
        // let teachers_institute = $("#teachers_institute").val();
        // $.ajax({
        //   type: "POST",
        //   dataType: "json",
        //   url: "{{url('')}}",
        // })
      }
    </script> --}}



  </body>
</html>