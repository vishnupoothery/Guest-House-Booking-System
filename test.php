 <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>NITC GH</title>
  </head>


<table class="table">
        <tr class="collapserow" onclick="col(0);">
            <td>
           one
            </td>
            <td>
            another
            </td>
        </tr>
        <tr id="collapse0" class="collapse out"><td colspan="2"><div>Should be collapsed</div></td></tr>
    <tr class="collapserow" onclick="col(1);">
            <td>
           one
            </td>
            <td>
            another
            </td>
        </tr>
        <tr id="collapse1" class="collapse out"><td colspan="2"><div>Should be collapsed</div></td></tr>


    </table>
      <script>
          function col(op)
          { var ele=document.getElementById("collapse"+op);
              if (ele.classList.contains('out'))
                  {
                      ele.classList.add('in');
                      ele.classList.remove('out');
                  }
            else
                {
                    ele.classList.add('out');
                    ele.classList.remove('in');
                }

          }


      </script>
