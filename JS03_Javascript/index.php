<?php 
    $username = "attendance_app";
    $password = "4tt3ndance!";
    $database = "macscanner";
    $mysqli = new mysqli("34.82.192.248", $username, $password, $database);
    $query = "SELECT * FROM vw_dosen_status";
    $result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruang Dosen 02</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://jti.polinema.ac.id/wp-content/themes/jti-polinema/images/misc/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        img {
            width: 80px;
            height: 80px;
            border: 2px solid #6c757d;
            border-radius: 10px;
        }

        .item {
            margin: 3px;
            padding: 3px;
        }
        .card-default.card-outline {
            border-top: 3px solid #6c757d;
        }
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 1rem;
        }
        .status{
            padding: 3px;
            border-radius: 5px;
            text-align: center;
            color: white;
            font-weight: bold;
        }
        .ada{
            background-color: #007bff;
        }
        .tidak-ada{
            background-color: #ffc107;
        }
        table tr td {
            padding: 5px !important;
        }
        .for-name {
            font-weight: bold;
            height: 85px;
        }
        h3 > small {
            font-size: 60%;
            font-weight: 400;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row my-3 border-bottom">
            <div class="col-6">
                <h1 onclick="alert('halo')" class="text-primary font-weight-bold">Status Dosen</h1>
            </div>
            <div class="col-6">
                <h3 class="text-right text-primary font-weight-bolder mt-3"><span class="jclock"></span>
                <small>Last Update: <span class="last_update"><?php echo date('Y-m-d H:i:s')?></span></small>
            </h1>
            </div>
        </div>
        <div class="row">
        <?php 

            while ($row = $result->fetch_object()) { 
                $ada = (!is_null($row->last_minute) and $row->last_minute <= 10);    
        ?>
            <div class="col-3">
                <div class="card card-outline card-default">
                    <div class="card-body p-3">
                        <table class="table mb-0 border-bottom">
                            <tr>
                                <td rowspan="3" class="align-middle"><img src="<?php echo $row->avatar ?>" alt="" /></td>
                                <td class="align-middle for-name"><?php echo $row->name ?></td>
                            </tr>
                            <tr>
                                <td class="status_<?php echo $row->user_id ?>">
                                    <?php 
                                        if($ada){
                                            echo "<div class='status ada'>Ada</div>";
                                        } else {
                                            echo "<div class='status tidak-ada'>Tidak Ada</div>";
                                        } 
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        <?php }  ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="jquery.jclock.min.js"></script>

    <script language="javascript" type="text/javascript">
        var v = "1.0.0";
        const x = '12';
        let y; 

        console.log(v);
        $(document).ready(function(){
            $('.jclock').jclock();

            setInterval(function(){
                $.ajax({
                    url: 'ajax.php',
                    type: 'GET',
                    success: function(response){
                        if(response.status){
                            $.each(response.detail, function(k, v){
                                if(parseInt(v.status) == 1){
                                    $('.status_'+v.user_id).html("<div class='status ada'>Ada</div>");
                                } else {
                                    $('.status_'+v.user_id).html("<div class='status tidak-ada'>Tidak Ada</div>");
                                }
                            });
                            $('.last_update').html(response.last_update);
                        }
                    }
                });
            }, 60000);
        });
    </script>
</body>
</html>