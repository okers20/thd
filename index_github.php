<?php
    //Koneksi Database
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "dbtreashelpdesk";

    //Buat Koneksi
    $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi)) ;


    //Jika button save di klik
    if (isset($_POST['bsimpan'])) {

        //Pengujian apakah data akan di edit atau disimpan baru
        if (isset($_GET['hal']) == "save") {
            //Data akan di edit
            $edit = mysqli_query($koneksi, "UPDATE table_isi SET
                                                   issue = '$_POST[tissue]',
                                                   description = '$_POST[tdescription]',
                                                   keyword = '$_POST[tkey]'
                                            WHERE id_no = '$_GET[id]'
                                           ");
        

            //Uji jika edit data sukses
            if($edit) {
                echo "<script>
                        alert('SUCCESS EDIT data GAES!');
                        document.location='index.php';
                    </script>";

            } else {
                echo "<script>
                    alert('FAILED EDIT data!');
                    document.location='index.php';
                    </script>";
            }
        } else {
            //Data akan disimpan baru
            $simpan = mysqli_query($koneksi, " INSERT INTO table_isi (issue, description, keyword)
                                                VALUE ( '$_POST[tissue]',
                                                        '$_POST[tdescription]',
                                                        '$_POST[tkey]' )
                                                     ") ;

            //Uji jika simpan data sukses
            if ($simpan) {
                echo "<script>
                alert('SUCCESS GAES!');
                document.location='index.php';
                </script>";

            } else {
                echo "<script>
                alert('FAILED to save data!');
                document.location='index.php';
                </script>";
            }

        }

    }

    //Deklarasi variabel untuk menampung data yang akan di edit
    $vissue = "";
    $vdescription = "";
    $vkey = "";


    //Pengujian jika button edit / delete di klik
    if(isset($_GET['hal'])) {

        //Pengujian jika edit data
        if($_GET['hal'] == "edit") {


            //Tampilkan data yang akan diedit
            $tampil = mysqli_query($koneksi, "SELECT * FROM table_isi WHERE id_no = '$_GET[id]'") ;
            $data = mysqli_fetch_array($tampil);
            if($data){
                //Jika data ditemukan, maka data ditampung ke dalam variabel
                $vissue = $data ['issue'];
                $vdescription = $data ['description'];
                $vkey = $data ['keyword'];

            }
        }else if ($_GET['hal'] == "delete") {
            //persiapan hapus data
            $delete = mysqli_query($koneksi, "DELETE FROM table_isi WHERE id_no = '$_GET[id]' ") ;
            
            //Uji jika delete data sukses
            if ($delete) {
            echo "<script>
            alert('SUCCESS DELETE GAES!');
            document.location='index.php';
            </script>";
            
            } else {
            echo "<script>
            alert('FAILED DELETE data!');
            document.location='index.php';
            </script>";
            }
            
        } 

    }


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Treasury Help Desk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>


  <nav class="navbar bg-info">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="public_html/kotak pos 2.png" alt="Logo" width="60" height="60" class="d-inline-block align-text-center">
      BosPoch
    </a>
  </div>
</nav>

  <body>


  <!-- awal container -->
    <div class="container">

        <h3 class="text-center mt-2">TREASURY HELPDESK</h3>
        <h6 class="text-center">Alfi, Dewi, Riciz, Lina (ADIL)</h6>

        <!-- awal box -->
        <div class="row">

            <!-- awal col md 7 -->
            <div class="col-md-7 mx-auto"> 

                <!-- awal card input -->
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Input
                    </div>

                    <div class="card-body">

                        <!-- awal form -->
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Issue</label>
                                <input type="text" name="tissue" value="<?=$vissue?>" class="form-control" placeholder="type here">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" name="tdescription" value="<?=$vdescription?>" class="form-control" placeholder="type here">
                            </div>

                            <div class="mb-3">
                            <label class="form-label">KeyWord</label>
                            <select class="form-select" name="tkey">
                                <option value="<?= $vkey ?>"><?=$vkey ?></option>
                                <option value="AKTT">AKTT</option>
                                <option value="Auto Debet">Auto Debet</option>
                                <option value="MisDebt">MisDebt</option>
                                <option value="Payment">Payment</option>
                                <option value="Reccuring">Reccuring</option>
                                <option value="Refund">Refund</option>
                                <option value="Suspense">Suspense</option>
                                <option value="VA">VA</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            </div>

                            <div class="text-center">
                                <hr>
                                <button class="btn btn-success" name="bsimpan" type="submit">Save </button>
                                <button class="btn btn-secondary" name="breset" type="reset">Reset </button>

                            </div>

                        </form>
                        <!-- awal form -->

                    </div>

                    <div class="card-footer bg-info text-light">
                    </div>

                </div>
                <!-- akhir card input -->

            </div>
            <!-- akhir col md 7 -->

        </div>
        <!-- akhir box -->

                        <!-- awal card info -->
                    <div class="card mt-5">
                    <div class="card-header bg-info text-light">
                        Info
                    </div>

                    <div class="card-body">
                        <div class="col-md-7 mx-auto">
                            <form method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" name="tcari" class="form-control" placeholder="type here!">
                                    <button class="btn btn-primary" name="bcari" type="submit">Search </button>
                                    <button class="btn btn-secondary" name="bclear" type="submit">Clear </button>
                                </div>
                            </form>
                        </div>

                        <table class="table table-striped table-hover table-bordered">
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Issue</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">KeyWord</th>
                                <th class="text-center">Action</th>
                            </tr>

                            <?php
                                //Persiapan menampilkan data
                                $no = 1;

                                //Untuk pencarian data
                                //Jika button search di klik
                                if (isset($_POST['bcari'])) {
                                    //Tampilkan data yang dicari
                                    $keyword = $_POST['tcari'];
                                    $q = "SELECT * FROM table_isi WHERE issue like '%$keyword%' or description like '%$keyword%' or keyword like '%$keyword%'
                                    order by id_no desc ";
                                }else{
                                    $q =  "SELECT * FROM table_isi order by id_no desc" ;
                                }

                                $tampil = mysqli_query ($koneksi, $q );
                                while($data = mysqli_fetch_array($tampil)) :
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['issue']?></td>
                                <td><?= $data['description']?></td>
                                <td><?= $data['keyword']?></td>
                                <td>
                                    <a href="index.php?hal=edit&id=<?=$data['id_no']?>" class="btn btn-warning">Edit</a>

                                    <a href="index.php?hal=delete&id=<?=$data['id_no']?>"
                                    class="btn btn-danger" onclick="return confirm('Yakin mo dihapus?')">Delete</a>
                                </td>
                            </tr>

                            <?php endwhile; ?>

                        </table>
                    </div>

                    <div class="card-footer bg-info text-light">
                    </div>

                </div>
                <!-- akhir card info -->



    </div>
  <!-- akhir container -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>