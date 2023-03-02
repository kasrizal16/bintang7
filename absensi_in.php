<?php 
include "Connections/cnn.php";
session_start();
if($_SESSION['status']!="login"){
	header("location:signin?pesan=belum_login");
}else{ 
	$nik = $_SESSION['nik'];
	$id = $_POST['id'];
    $clock_in=$_POST['clock_in'];
    $created_date=$_POST['created_date'];
    $reason=$_POST['reason'];
    $jam_sekarang=$_POST['jam_sekarang'];
// update data ke database
	mysqli_query($connection,"INSERT INTO `log_absensi`
    VALUES (NULL,'$id','CLOCK-IN','$jam_sekarang','$created_date','$reason','$nik',now(),'$clock_in');");
    mysqli_query($connection,"UPDATE
        `absen_slip_gaji`
    SET
        `clock_in` = '$jam_sekarang',
        `update_date` = now(),
        `update_by` = '$nik'
    WHERE `id` = '$id';");
	header("location:master_absen_gaji");
}