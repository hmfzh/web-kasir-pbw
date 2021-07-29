<?php
session_start();
include "config/koneksi_input.php";
$data=mysqli_query($con , "select * from tblbarang");
$order=isset($_GET['order'])?$_GET['order']:null;




if (empty($_SESSION['login'])) {
    header('Location: index.php');
} 
if($order=='kode'){
    echo"<option>Kode Barang</option>";
    while($r=mysqli_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($order=='barang'){
    echo'<table id="barang" class="table table-hover">
    <thead>
    <tr>
    <Td colspan="5"><a href="?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a></td>
    </tr>
    <tr>
    <td>Kode Barang</td>
    <td>Nama Barang</td>
    <td>Harga Beli</td>
    <td>Harga Jual</td>
    <td>Stok</td>
    </tr>
    </thead>';
    while ($b=mysqli_fetch_array($data)){
        echo"<tr>
        <td>$b[kode]</td>
        <td>$b[nama]</td>
        <td>$b[hrg_beli]</td>
        <td>$b[hrg_jual]</td>
        <td>$b[stok]</td>
        </tr>";
    }
    echo "</table>";
}elseif($order=='ambildata'){
    $kode=$_GET['kode'];
    $dataambil=mysqli_query($con,"select * from tblbarang where kode='$kode'");
    $d=mysqli_fetch_array($dataambil);
    echo $d['nama']."|".$d['hrg_beli']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($order=='cek'){
    $kd=$_GET['kd'];
    $sql=mysqli_query($con,"select * from tblbarang where kode='$kd'");
    $cek=mysqli_num_rows($sql);
    echo $cek;
}elseif($order=='update'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $beli=htmlspecialchars($_GET['beli']);
    $jual=htmlspecialchars($_GET['jual']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $update=mysqli_query($con,"update tblbarang set nama='$nama',
        hrg_beli='$beli',
        hrg_jual='$jual',
        stok='$stok'
        where kode='$kode'");
    if($update){
        echo "Sukses";
    }else{
        echo "ERROR. . .";
    }
}elseif($order=='delete'){
    $kode=$_GET['kode'];
    $del=mysqli_query($con,"delete from tblbarang where kode='$kode'");
    if($del){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($order=='simpan'){
    $kode=$_GET['kode'];
    $nama=htmlspecialchars($_GET['nama']);
    $jual=htmlspecialchars($_GET['jual']);
    $beli=htmlspecialchars($_GET['beli']);
    $stok=htmlspecialchars($_GET['stok']);
    
    $tambah=mysqli_query($con,"insert into tblbarang (kode,nama,hrg_beli,hrg_jual,stok)
        values ('$kode','$nama','$beli','$jual','$stok')");
    if($tambah){
        echo "sukses";
    }else{
        echo "error";
    }
}
?>