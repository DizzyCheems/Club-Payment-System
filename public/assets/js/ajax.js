
$(document).ready(function(){

  // if table list for categories exist
  //if($('#get-categories').length) 
 // {
 //     getcategories();
 // }
  if($('#get-employees').length) 
  {
       getemployees();
  }
  if($('#get-users').length) 
  {
      getusers();
  }

  if($('#get-customers').length) 
  {
      getcustomers();
  }
 
  if($('#get-items').length) 
  {
      getitems();
  }
  if($('#get-persons').length) 
  {
      getpersons();
  }  
  });

   function getemployees() {
    $.ajax({
      url: "/employees/ajax",
      method: 'get',
      success: function(response) {
        $("#get-employees").html(response);
        $("table").DataTable({
          order: [0, 'desc']
        });
      }
     });
     }

function getitems() {
  $.ajax({
    url: 'item/ajax',
    method: 'get',
    success: function(response) {
      $("#get-items").html(response);
      $("table").DataTable({
        order: [0, 'desc']
      });
    }
  });
}

function getcustomers() {
  $.ajax({
    url: 'customers/ajax',
    method: 'get',
    success: function(response) {
      $("#get-customers").html(response);
      $("table").DataTable({
        order: [0, 'desc']
      });
    }
   });
}

    // delete Customer ajax request
    $(document).on('click', '.dropdown-item-delete-customer', function(e) {
      e.preventDefault();
      let id = $(this).attr('id');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/customer/delete',
            method: 'get',
            data: {
              id: id,
              _token: csrf
            },
            success: function(response) {
              console.log(response);
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              getcustomers();
            }
          });
        }
      })
    });

    $(document).on('click', '.dropdown-item-delete-employee', function(e) {
     
      e.preventDefault();
      let id = $(this).attr('id');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: 'employee/destroy' ,
            method: 'get',
            data: {
              id: id,
              _token: csrf
            },
            success: function(response) {
              console.log(response);
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              getemployees();
            }
          });
        }
      })
    });

    
    // delete Job-Order ajax request
    $(document).on('click', '.dropdown-item-delete-job-order', function(e) {
      e.preventDefault();
      let id = $(this).attr('id');
      let csrf = '{{ csrf_token() }}';
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/job-order/delete',
            method: 'get',
            data: {
              id: id,
              _token: csrf
            },
            success: function(response) {
              console.log(response);
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              getjoborders();
            }
          });
        }
      })
    });
      
      function getpersons() {      
      $.ajax({
       url: "/users/ajax",
       method: 'get',
       success: function(response) {
         $("#get-persons").html(response);
         $("table").DataTable({
           order: [0, 'desc']
         });
       }
      });
      }

      