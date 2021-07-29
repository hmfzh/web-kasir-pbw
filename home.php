<?php
function getDayIndonesia($date)
{
  if($date != '0000-00-00'){
    $data = hari(date('D', strtotime($date)));
  }else{
    $data = '-';
  }

  return $data;
}


function hari($day) {
  $hari = $day;

  switch ($hari) {
    case "Sun":
    $hari = "Minggu";
    break;
    case "Mon":
    $hari = "Senin";
    break;
    case "Tue":
    $hari = "Selasa";
    break;
    case "Wed":
    $hari = "Rabu";
    break;
    case "Thu":
    $hari = "Kamis";
    break;
    case "Fri":
    $hari = "Jum'at";
    break;
    case "Sat":
    $hari = "Sabtu";
    break;
  }
  return $hari;
}



?>

<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="shortcut icon" href="img/kasir.PNG">
</head>
<body>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Info Admin</h3>
      </div>


      <table class="table" style="margin-bottom: 240px;">
        <tbody>
          <tr>
            <th scope="row">Terakhir Login  </th>
            <td><?php echo date('d-m-Y'); ?></td>
          </tr>
          <tr>
            <th scope="row">Hari</th>
            <td><?php  $hari_ini   = date('Y-m-d');
            echo getDayIndonesia($hari_ini); ?></td>
          </tr>
          <tr>
            <th scope="row">Waktu Login</th>
            <td><?php echo date_default_timezone_set('Asia/Jakarta'); echo date(' h:i:s A'); ?></td>
          </tr>

          <tr>

            <th scope="row">IP Addres</th>
            <td><?php echo $_SERVER["REMOTE_ADDR"]; ?></td>
          </tr>

          <tr>
            <th scope="row">Server</th>
            <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
          </tr>


          <tr>
            <th scope="row">Browser</th>
            <td><?php echo $_SERVER["HTTP_USER_AGENT"]; ?></td>
          </tr>


        </tbody>
      </table>







      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>





