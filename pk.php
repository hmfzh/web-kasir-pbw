<?php
session_start();
include "config/koneksi_input.php";

if (empty($_SESSION['login'])) {
    header('Location: index.php');
} 

$order=isset($_GET['order'])?$_GET['order']:null;
if($order=='ambilbarang'){
    $data=mysqli_query($con,"select * from tblbarang");
    echo"<option>Kode Barang</option>";
    while($r=mysqli_fetch_array($data)){
        echo "<option value='$r[kode]'>$r[kode]</option>";
    }
}elseif($order=='ambildata'){
    $kode=$_GET['kode'];
    $dataambil=mysqli_query($con,"select * from tblbarang where kode='$kode'");
    $d=mysqli_fetch_array($dataambil);
    echo $d['nama']."|".$d['hrg_jual']."|".$d['stok'];
}elseif($order=='barang'){
    $brg=mysqli_query($con,"select * from tblsementara");
    echo "<thead>
    <tr>
    <td>Kode Barang</td>
    <td>Nama</td>
    <td>Harga</td>
    <td>Jumlah Beli</td>
    <td>Subtotal</td>
    <td>Tools</td>
    </tr>
    </thead>";
    $total=mysqli_fetch_array(mysqli_query($con,"select sum(subtotal) as total from tblsementara"));
    while($r=mysql_fetch_array($brg)){
        echo "<tr>
        <td>$r[kode]</td>
        <td>$r[nama]</td>
        <td>$r[harga]</td>
        <td><input type='text' name='jum' value='$r[jumlah]' class='span2'></td>
        <td>$r[subtotal]</td>
        <td><a href='pk.php?order=hapus&kode=$r[kode]' id='hapus'>Hapus</a></td>
        </tr>";
    }
    echo "<tr>
    <td colspan='3'>Total</td>
    <td colspan='4'>$total[total]</td>
    </tr>";
}elseif($order=='tambah'){
    $kode=$_GET['kode'];
    $nama=$_GET['nama'];
    $harga=$_GET['harga'];
    $jumlah=$_GET['jumlah'];
    $subtotal=$harga*$jumlah;
    
    $tambah=mysqli_query($con,"INSERT into tblsementara (kode,nama,harga,jumlah,subtotal)
        values ('$kode','$nama','$harga','$jumlah','$subtotal')");
    
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($order=='hapus'){
    $kode=$_GET['kode'];
    $del=mysqli_query($con,"delete from tblsementara where kode='$kode'");
    if($del){
        echo "<script>window.location='index.php?page=penjualan&act=tambah';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
        window.location='index.php?page=penjualan&act=tambah';</script>";
    }
}elseif($order=='proses'){
    $nota=$_GET['nota'];
    $tanggal=$_GET['tanggal'];
    $to=mysqli_fetch_array(mysqli_query($con,"select sum(subtotal) as total from tblsementara"));
    $tot=$to['total'];
    $simpan=mysqli_query($con,"insert into penjualan(nonota,tanggal,total)
        values ('$nota','$tanggal','$tot')");
    if($simpan){
        $query=mysqli_query($con,"select * from tblsementara");
        while($r=mysqli_fetch_row($query)){
            mysqli_query($con,"insert into detailpenjualan(nonota,kode,harga,jumlah,subtotal)
                values('$nota','$r[0]','$r[2]','$r[3]','$r[4]')");
            mysqli_query($con,"update tblbarang set stok=stok-'$r[3]'
                where kode='$r[0]'");
        }
        //hapus seluruh isi tabel sementara
        mysqli_query($con,"truncate table tblsementara");
        echo "sukses";
    }else{
        echo "ERROR";
    }
}
?>