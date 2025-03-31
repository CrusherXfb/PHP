<h2>This is Gallery</h2>

<p>Выберите расширения для отображения</p>
<form action="index.php?page=3" method="post">
    <select name="ext">
        <?php
            $path = 'images/';
            if ($dir = opendir($path)) {
                $extarr = [];
                while ($file = readdir($dir)) {
                    $pos = strrpos($file,'.');
                    $ext = strtolower(substr($file, $pos));
                    if (!in_array($ext, $extarr) && $ext != '.' && $ext != '') {
                        $extarr[] = $ext;
                        echo "<option>$ext</option>";
                    }
                }
                closedir($dir);
            }
        ?>
    </select>
    <button type="submit" class="btn btn-primary" name="galbtn">Загрузить</button>
</form>
<?
if(isset($_POST['galbtn'])) {
    $ext = htmlentities($_POST['ext']);
    $filesArr = glob("$path*$ext");
    echo "<div class='panel panel-primary'>";
    echo '<div class="panel-heading">';
    echo '<h3 class="panel-title">Gallery content</h3></div>';
    foreach ($filesArr as $file) {
        echo "<a href='$file' target='_blank'>
                <img src='$file' height='100px' border ='0' alt='pic' class='img-polaroid'>
              </a>";
    }
    echo "</div>";
    
}



