<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "store");



function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek ketersediaan username
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");


    if(mysqli_fetch_assoc($result)){
        echo "<script>
        alert('username sudah digunakan'); 
        </script>
        ";
        return false;
    }

    if ( $password !== $password2 ){
        echo "<script>
                alert('konfirmasi password tidak sesuai');
            </script>";
        return false; 
    }
    // enkripsi
    $password = password_hash($password, PASSWORD_DEFAULT);
    // tambahkan ke database
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}


?>