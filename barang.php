<!DOCTYPE html>
<html>
<head>
    <title>Form Barang</title>
    <link rel="shortcut icon" href="img/kasir.PNG">
    <script src="js/jquery.js"></script>
    <script>
                
                 var kode;
                 var nama;
                 var beli;
                 var jual;
                 var stok;
                 $(function(){
                    $("#kode").load("proses.php","order=kode");
                    $("#barang").load("proses.php","order=barang");
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
                                $("#beli").val(data[1]);
                                $("#jual").val(data[2]);
                                $("#stok").val(data[3]); 
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    
                    $("#kode2").change(function(){
                        var kd=$("#kode2").val();
                        
                        $.ajax({
                            url:"proses.php",
                            data:"order=cek&kd="+kd,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('Kode Barang Bisa digunakan');
                                    $("#kode2").css('border','3px #090 solid');
                                }else{
                                    $("#pesan").html('Kode Barang sudah ada');
                                    $("#kode2").css('border','3px #c33 solid');
                                }
                            }
                        });
                    });
                    $("#update").click(function(){
                        kode=$("#kode").val();
                        if(kode=="Kode Barang"){
                            alert("Pilih Kode barang dulu");
                            exit();
                        }
                        nama=$("#nama").val();
                        beli=$("#beli").val();
                        jual=$("#jual").val();
                        stok=$("#stok").val();
                        $("#status").html('sedang diupdate. . .');
                        $("#loading").show();
                        $.ajax({
                            url:"proses.php",
                            data:"order=update&kode="+kode+"&nama="+nama+"&beli="+beli+"&jual="+jual+"&stok="+stok,
                            cache:false,
                            success:function(msg){
                                if(msg=='Sukses'){
                                    $("#status").html('Update Berhasil. . .');
                                }else{
                                    $("#status").html('ERROR. . .')
                                }
                                $("#loading").hide();

                                $("#barang").load("proses.php","order=barang");
                                $("#kode").load("proses.php","order=kode");
                            }
                        });
                    });
                    $("#hapus").click(function(){
                        kode=$("#kode").val();
                        if(kode=="Kode Barang"){
                            alert("Kode barang belim dipilih");
                            exit();
                        }
                        $("#status").html('Sedang Dihapus. . .');
                        $("#loading").show();
                        
                        $.ajax({
                            url:"proses.php",
                            data:"order=delete&kode="+kode,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html('Berhasil Dihapus. . .');
                                }else{
                                    $("#status").html('ERROR. . .');
                                }
                          
                                $("#barang").load("proses.php","order=barang");
                                $("#kode").load("proses.php","order=kode");
                                
                            }
                        });
                    });
                   $("#simpan").click(function(){
                    kode=$("#kode2").val();
                    if(kode==""){
                        alert("Kode Barang Harus diisi");
                        exit();
                    }
                    nama=$("#nama").val();
                    beli=$("#beli").val();
                    jual=$("#jual").val();
                    stok=$("#stok").val();
                    $("#status").html("sedang diproses. . .");
                    $("#loading").show();

                    $.ajax({
                        url:"proses.php",
                        data:"order=simpan&kode="+kode+"&nama="+nama+"&beli="+beli+"&jual="+jual+"&stok="+stok,
                        cache:false,
                        success:function(msg){
                            if(msg=="sukses"){
                                $("#status").html("Berhasil disimpan. . .");
                            }else{
                                $("#status").html("ERROR. . .");
                            }
                            $("#loading").hide();
                            $("#nama").val("");
                            $("#jual").val("");
                            $("#beli").val("");
                            $("#stok").val("");
                            $("#kode2").val("");
                        }
                    });
                });
               });
           </script>

       </script>
   </head>
   <body>
    <div style="padding-bottom: 150px;">
        <?php
        $p=isset($_GET['act'])?$_GET['act']:null;
        switch($p){
            default:
            echo'
            <legend>Data Barang</legend>
            <div class="form-group">
            <label>Kode Barang</label>
            <select class="custom-select mr-sm-2" id="kode"></select><br>
            <div class="form-group">
            <label for="exampleInputnName">Nama Barang</label>
            <input type="text" id="nama" class="form-control" required>
            </div>


            <div class="form-group">
            <label for="exampleInputName">Harga Beli</label>
            <input type="text" id="beli" class="form-control span2" required>
            </div>

            <div class="form-group">
            <label for="exampleInputName">Harga Jual</label>
            <input type="text" id="jual" class="form-control span2" required>
            </div>
            <div class="form-group">
            <label for="exampleInputName">Stok</label>
            <input type="text" id="stok" class="form-control span1" required>
            </div>

            </div>

            <button class="btn btn-outline-success" id="update" class="btn">Update</button>
            <button class="btn btn-outline-danger" id="hapus" class="btn">Hapus</button><br><br>
            <div id="status"></div>
            <div id="barang"></div>';
            break;

            case "tambah":
            echo'<legend>Tambah Data Barang</legend>

            <l<div class="form-group">
            <label for="exampleInputEmail1">Kode Barang</label>
            <input type="text"  id="kode2" class="form-control" required> <span id="pesan"></span>

            <div class="form-group">
            <label for="exampleInputnName">Nama Barang</label>
            <input type="text" id="nama" class="form-control" required>
            </div>

            


            <div class="form-group">
            <label for="exampleInputName">Harga Beli</label>
            <input type="text" id="beli" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="exampleInputName">Harga Jual</label>
            <input type="text" id="jual" class="form-control" required>
            </div>
            <div class="form-group">
            <label for="exampleInputName">Stok</label>
            <input type="text" id="stok" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary" id="simpan">Simpan</button>

            <a href="?page=barang" class="btn btn-secondary">Kembali</a>
            <div id="status"></div>';
            break;
        }
        ?>
    </div>
    </html>