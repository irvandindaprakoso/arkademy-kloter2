<?php 
    require "database.php";
    require "Arkademy-class.php";
    $class_arkademy     = new Arkademy($pdo);
    $view               = $class_arkademy->view();
    $work               = $class_arkademy->selectWork();
    $category           = $class_arkademy->selectCategory();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="animate.css" rel="stylesheet">
    <script src="jquery.js"></script>

    <title>Arkademy</title>
  </head>
  <body class="nav-md">
    <div class="container body">
        <div class="row">
            <div class="col-md-12">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#btnAdd">Add</button>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Work</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($view as $data): ?>
                        <tr>
                            <td><?=$data->name ?></td>
                            <td><?=$data->work ?></td>
                            <td><?=$data->salary?></td>
                            <td>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#btnEdit<?=$data->id?>">Edit</button>
                                <button type="button" class="btn btn-danger " data-target="#delete-nm" data-user="<?php echo $data->id; ?>" data-nm="<?php echo $data->name; ?>" data-hapus="<?php echo $data->id; ?>"  title="Delete" data-toggle="modal">Delete</button>
                            </td>
                        </tr>
                        <div class="modal" id="btnEdit<?=$data->id?>">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Data</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <form id="frmEdit<?=$data->id?>">
                                            <input type="hidden" class="form-control" id="id" name="id" value="<?=$data->id?>">

                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name" value="<?=$data->name?>">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" id="work" name="work" form="frmEdit<?=$data->id?>">
                                                    <option value="<?=$data->id?>"><?=$data->work?></option>
                                                    <option value="<?=$data->id?>"><?=$data->work?></option>
                                                </select>
                                            </div> 
                                            <div class="form-group">
                                                <select class="form-control" id="salary" name="salary" form="frmEdit<?=$data->id?>">
                                                    <option value="<?=$data->id?>"><?=$data->salary?></option>
                                                </select>
                                            </div> 
                                            <div class="modal-footer">
                                                <button id="btnUpdate<?php echo $data->id?>" type="submit" class="btn btn-info" >Update</button>
                                            </div>
                                        </form>
                                    </div>           
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                            // Update Name 
                                var requestedit;
                                $("#frmEdit<?=$data->id?>").submit(function(event){
                                    // Abort any pending requestadd
                                    if (requestedit) {
                                        requestedit.abort();
                                    }
                                    var $form = $(this);
                                    var $inputs = $form.find("input, button");
                                    var serializedData = $form.serialize();

                                    requestedit = $.ajax({
                                        url: "name-update.php",
                                        type: "post",
                                        beforeSend: function(){ $("#btnUpdate<?=$data->id?>").html('<i class="fa fa-spinner fa-pulse"></i> Updating...');},
                                        data: serializedData
                                    });
                                    // Callback handler
                                    requestedit.done(function (msg){
                                        console.log(msg);
                                        if(msg=='success') {
                                            setTimeout(function() {
                                                window.location="index.php";
                                            }, 2000);
                                        }
                                        else {
                                            $("#btnUpdate<?=$data->id?>").html('<i class="fa fa-check"></i> Edit');
                                        }
                                    });
                                    requestedit.always(function () {
                                        $inputs.prop("disabled", false);
                                    });
                                    event.preventDefault();
                                });
                            });
                        </script>
                    <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <!-- The Modal -->
    <div class="modal" id="btnAdd">
        <div class="modal-dialog">
            <div class="modal-content">
        
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            
            <!-- Modal body -->
                <div class="modal-body">
                    <form id="frmAdd">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="Name..." name="name">
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="work" name="work" form="frmAdd">
                                <?php foreach ($work as $data):?>
                                    <option value="<?=$data->id?>"><?=$data->name?></option>
                                <?php endforeach ?>
                            </select>
                        </div> 
                        <div class="form-group">
                            <select class="form-control" id="salary" name="salary" form="frmAdd">
                                <?php foreach ($category as $data):?>
                                    <option value="<?=$data->id?>"><?=$data->salary?></option>
                                <?php endforeach ?>
                            </select>
                        </div> 
                        <div class="modal-footer">
                            <button id="btnAdd" type="submit" class="btn btn-info" >ADD</button>
                        </div>
                    </form>
                </div>           
            </div>
        </div>
    </div>
    <div class="modal animated rotateInUpLeft" id="delete-nm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Yakin Akan Menghapus Data "<span id="nm"></span>" ? </p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        //Delete Handler
                        $deleteit   = sha1("deleteit");
                        $id         = $_POST['id'];
                        $del        = $class_arkademy->delete($id);
                        echo "<script>setTimeout(function() {
                            window.location='index.php';
                        }, 2000);</script>";
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">

        $('#delete-nm').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
            $(this).find('#nm').html($(e.relatedTarget).data('nm'));
        });
        // Add Name 
        var requestadd;
        $("#frmAdd").submit(function(event){
            // Abort any pending requestadd
            if (requestadd) {
                requestadd.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();

            requestadd = $.ajax({
                url: "name-add.php",
                type: "post",
                beforeSend: function(){ $("#btnAdd").html('<i class="fa fa-spinner fa-pulse"></i> Adding...');},
                data: serializedData
            });
            // Callback handler
            requestadd.done(function (msg){
                console.log(msg);
                if(msg=='success') {
                    setTimeout(function() {
                        window.location="index.php";
                    }, 2000);
                }
                else {
                    $("#btnAdd").html('<i class="fa fa-check"></i> add');
                }
            });
            requestadd.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        
    </script>
  </body>
</html>