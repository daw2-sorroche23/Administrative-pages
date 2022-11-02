<?php
$db = mysqli_connect('localhost', 'root', 'Pokemon2001!') or 
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = 0;
    $people_isdirector = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?>People</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>Nombre completo:</td>
     <td><input type="text" name="people_name"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr>
    <td>Actor/Director</td>
    <td> <select name="profesion">
        <?php 
        if($_GET['action'] == 'edit'){
            if($people_isactor == 1){
                echo '<option value="actor" selected="selected">Actor</option>';
                echo '<option value="director">Director</option>';
            }else{
                echo '<option value="director" selected="selected">Director</option>';
                echo '<option value="actor">Actor</option>';
            }  
        }else{
            echo '<option value="actor">Actor</option>';
            echo '<option value="director">Director</option>';
        }
        ?>
     </select>
     </td>
    </tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>