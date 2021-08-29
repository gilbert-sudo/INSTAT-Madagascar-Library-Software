color="#2f4a5d"
color="#5F6C75"
color="#2F495C"
color="#889BA8"
color="#7DC3F5"

color="#BF0000"
<?php 
echo '<script type="text/javascript">
alert("bonjour");
</script>';
?>

// <span style="text-decoration:line-through;"> RS'.$row["MRP"].'</span> 
                                    // | '.$row["Discount"].'% discount


swal({
title: 'Auto close alert!',
text: 'I will close in 5 seconds.',
timer: 5000,
button: false
})



if (isset($_GET['Message'])) {
    echo '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}