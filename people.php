<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
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
  <title><?php echo ucfirst($_GET['action']); ?> People</title>
 </head>
 <body>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>People Full Name</td>
     <td><input type="text" name="people_name"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr>
    <td>Es un actor o un director</td>
    <td> <select name="profesion">
            <?php
                if($_GET['action'] == 'edit'){
                    if($people_isactor == 1 && $people_isdirector == 0){
                        $actor= '<option value="actor" selected="selected">Actor</option>';
                    }else{
                        $actor= '<option value="actor">Actor</option>';
                    }
                    if($people_isdirector == 1 && $people_isactor == 0){
                        $director= '<option value="director" selected="selected">Director</option>';
                    }else{
                        $director= '<option value="director">Director</option>';
                    }
                    if($people_isdirector == 1 && $people_isactor == 1){
                        $ambos= '<option value="dos" selected="selected">Ambos</option>';
                    }else{
                        $ambos= '<option value="dos">Ambos</option>';
                    }   

                    echo $actor;
                    echo $director;
                    echo $ambos;
                }else{
                    echo '<option value="actor">Actor</option>';
                    echo '<option value="director">Director</option>';
                    echo '<option value="dos">Ambos</option>';
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
