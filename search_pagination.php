<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Page Description">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Paging</title>
    </head>
    <body>
        <br />
        <div class="container">
        <br />
        <div class="card">
            <div class="card-header">Data</div>
            <div class="card-body">
            <div class="form-group">
                <input type="text" name="search_box" id="search_box" class="form-control" placeholder="Type here to search.." />
            </div>
            <div class="table-responsive" id="content">
                
            </div>
            </div>
        </div>
        </div>
    </body>
</html>

<script text = "text/javascript">
    $(document).ready(function(){
        load_data(1);
        function load_data(page, query =''){
            $.ajax({
                url:"ajaxfile.php",
                method:"get",
                data:{page:page, query:query},
                success:function(data){
                    $('#content').html(data);
                }
            })            
        }
    
        $(document).on('click', '.page-link', function(){
            var page = $(this).data('page_number');
            var query = $('#search_box').val();
            load_data(page, query);
            });

            $('#search_box').keyup(function(){
            var query = $('#search_box').val();
            load_data(1, query);
        });
    });    
</script>


