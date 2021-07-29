
<!DOCTYPE html>
<html>
<head>
    <title>Transaki Penjualan</title>
    <link rel="shortcut icon" href="img/kasir.PNG">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.ui.datepicker.js"></script>
    <script>

                var nota;
                var tanggal;
                var kode;
                var nama;
                var harga;
                var jumlah;
                var stok;
                $(function(){
                    $("#kode").load("pk.php","order=ambilbarang");
                    $("#barang").load("pk.php","order=barang");
                    $("#nama").val("");
                    $("#harga").val("");
                    $("#jumlah").val("");
                    $("#stok").val("");
                    $("#kode").change(function(){
                        kode=$("#kode").val();
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        $.ajax({
                            url:"proses.php",
                            data:"order=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                $("#nama").val(data[0]);
                                $("#harga").val(data[1]);
                                $("#stok").val(data[3]);
                                $("#jumlah").focus();
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    $("#tambah").click(function(){
                        kode=$("#kode").val();
                        stok=$("#stok").val();
                        jumlah=$("#jumlah").val();
                        if(kode=="Kode Barang"){
                            alert("Kode Barang Harus diisi");
                            exit();
                        }else if(jumlah > stok){
                            alert("Stok tidak terpenuhi");
                            $("#jumlah").focus();
                            exit();
                        }else if(jumlah < 1){
                            alert("Jumlah beli tidak boleh 0");
                            $("#jumlah").focus();
                            exit();
                        }
                        nama=$("#nama").val();
                        harga=$("#harga").val();               
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();                        
                        $.ajax({
                            url:"pk.php",
                            data:"order=tambah&kode="+kode+"&nama="+nama+"&harga="+harga+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html("Berhasil disimpan. . .");
                                }else{
                                    $("#status").html("ERROR. . .");
                                }
                                $("#loading").hide();
                                $("#nama").val("");
                                $("#harga").val("");
                                $("#jumlah").val("");
                                $("#stok").val("");
                                $("#kode").load("pk.php","order=ambilbarang");
                                $("#barang").load("pk.php","order=barang");
                            }
                        });
                    });
                    $("#proses").click(function(){
                        nota=$("#nota").val();
                        tanggal=$("#tanggal").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"order=proses&nota="+nota+"&tanggal="+tanggal,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
                                    $("#status").html('Transaksi Pembelian berhasil');
                                    alert('Transaksi Berhasil');
                                    exit();
                                }else{
                                    $("#status").html('Transaksi Gagal');
                                    alert('Transaksi Gagal');
                                    exit();
                                }
                                $("#kode").load("pk.php","order=ambilbarang");
                                $("#barang").load("pk.php","order=barang");
                                $("#loading").hide();
                                $("#nama").val("");
                                $("#harga").val("");
                                $("#jumlah").val("");
                                $("#stok").val("");
                            }
                        })
                    })
                });
            </script>
        </head>
        <body>
            <div class="container" style="padding-bottom: 180px;">
                <?php
                include "config/koneksi_input.php";
                $p=isset($_GET['act'])?$_GET['act']:null;
                switch($p){
                    default:
                    echo "<table class='table table-bordered'>
                    <tr>
                    <td colspan='4'><a href='?page=penjualan&act=tambah' class='btn btn-primary'>Input Transaksi</a></td>
                    </tr>
                    <tr>
                    <td>No.Nota</td>
                    <td>Tanggal</td>
                    <td>Jumlah</td>
                    <td>Tools</td>
                    </tr>";
                    $query=mysqli_query($con ,"select * from penjualan");
                    while($r=mysqli_fetch_array($query)){
                        echo "<tr>
                        <td><a href='?page=penjualan&act=detail&nota=$r[nonota]'>$r[nonota]</a></td>
                        <td>$r[tanggal]</td>
                        <td>$r[total]</td>
                        <td><a href='?page=penjualan&act=detail&nota=$r[nonota]'>Cetak Nota</a></td>
                        </tr>";
                    }
                    echo"</table>";

                    break;
                    case "tambah":
                    $tgl=date('Y-m-d');
                        //untuk autonumber di nota
                    $auto=mysqli_query($con,"select * from penjualan order by nonota desc limit 1");
                    $no=mysqli_fetch_array($auto);
                    $angka=$no['nonota']+1;
                    echo "<div class='navbar-form pull-left'>
                    No. Nota : <input type='text' id='nota' value='$angka' readonly >
                    <input type='text' id='tanggal' value='$tgl' readonly>   
                    </div><br><br><br>";

                    echo'<div class="container">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModalLong">
                    Pemberitahuan Informasi
                    </button>

                    <!-- Modal -->
                    <div class=" container modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Informasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    <h5>Agar tidak terjadi error atau bug pada transaksi saat percobaan. Harap untuk memasukan jumlah beli 1.</h5>
                    <h5> Apabila tidak ada kendala saat proses transaksi silakan input jumlah beli sesuai keinginan.</h5>
                   
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    <legend>Transaksi Penjualan</legend><br>

                    
                    <div class="form-group">                  
                    <label>Kode Barang</label>
                    <select class="custom-select mr-sm-2" id="kode"></select><br>

                    <div class="form-group">
                    <label for="exampleInputnName">Nama Barang</label>
                    <input type="text" id="nama" class="form-control" span2 required>
                    </div>


                    <div class="form-group">
                    <label for="exampleInputName">Harga</label>
                    <input type="text" id="harga" class="form-control span2 required>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputName">Stok</label>
                    <input type="text" id="stok" class="form-control span1 required>
                    </div>

                    <div class="form-group">
                    <label for="exampleInputName">Jumlah Beli</label>
                    <input type="text" id="jumlah" class="form-control span1 required>
                    </div>
                    </div>
                    <span id="status"></span>
                    <table id="barang" class="table table-bordered">

                    </table>
                    <div class="form-actions">
                    <button class="btn btn-outline-primary" id="tambah">Tambah</button>

                    <button class="btn btn-outline-success" id="proses">Proses</button>

                    <a href="?page=penjualan" class="btn btn-secondary ml-5" style="float: right">Kembali</a>
                    </div>

                    

                    <span id="status"></span>
                    <table id="barang" class="table table-bordered">

                    </table>


                    '
                    ;
                    break;
                    case "detail":
                    echo "<legend>Nota Penjualan</legend> ";
                    $nota=$_GET['nota'];
                    $query=mysqli_query($con,"select penjualan.nonota,detailpenjualan.kode,tblbarang.nama,
                       detailpenjualan.harga,detailpenjualan.jumlah,detailpenjualan.subtotal
                       from detailpenjualan,penjualan,tblbarang
                       where penjualan.nonota=detailpenjualan.nonota and tblbarang.kode=detailpenjualan.kode
                       and detailpenjualan.nonota='$nota'");
                    $nomor=mysqli_fetch_array(mysqli_query($con,"select * from penjualan where nonota='$nota'"));
                    echo "<div class='navbar-form pull-left'>
                    Nota : <input type='text' value='$nomor[nonota]' disabled>
                    <input type='text' value='$nomor[tanggal]' disabled>
                    </div>";
                    echo "<br/>";
                    echo "<br/>";
                    echo "<br/>";
                    echo "<table class='table table-hover'>
                    <thead>
                    <tr>
                    <td>Kode Barang</td>
                    <td>Nama</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                    <td>Subtotal</td>
                    </tr>
                    </thead>";
                    while($r=mysqli_fetch_row($query)){
                        echo "<tr>
                        <td>$r[1]</td>
                        <td>$r[2]</td>
                        <td>$r[3]</td>
                        <td>$r[4]</td>
                        <td>$r[5]</td>
                        </tr>";
                    }
                    echo "<tr>
                    <td colspan='4'><h4 align='right'>Total</h4></td>
                    <td colspan='5'><h4>$nomor[total]</h4></td>
                    </tr>
                    </table>";
                    break;
                }
                ?>
            </div>
        </body>
        </html>