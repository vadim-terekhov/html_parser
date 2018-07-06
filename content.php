  <div class="row content mt-2 mb-2 ml-1 justify-content-start h-100">
    <div class="col-3 border p-2">
      <form action="chart.php" method="post">
        <div class="form-group">
          <label for="inputState" class="text-center h5 pt-2 pb-2">Выбeрите данные для построения графика</label>
          <select id="inputState" class="form-control" name="namefile">
            <option selected>Не выбрано</option>
            <?php
              $dir = './upload/';
              $files = scandir($dir);
              foreach($files as $file){
                if(preg_match('/\.(htm)/', $file)){
              ?>
                <option value="<?php echo $file; ?>">
                <?php echo $file; ?>
                </option>
            	<?php } ?>
            <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" name="bilder">Построить</button>
        <!--span class="text-success ml-2">График построен</span-->
      </form>
      <hr>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputGraph" class="text-center h5 pt-2 pb-2">Загрузить данные для построения графика</label>
          <input type="file" class="form-control-file" name="file" id="inputGraph">
        </div>
        <button type="submit" class="btn btn-primary" id="download" name="download">Загрузить</button>
        <!--span class="text-success ml-2">Добавлен</span-->
      </form>
    </div>

    <div class="col-9">
      <div class="border p2 h-100" id="curve_chart">
        <?php
          if($res_str == ''){
            echo '<div class="alert alert-warning">Нет данных для построения графика</div>';
          }
        ?>
      </div>
    </div>
  </div>

  <footer class="border-top h-20 pl-3">
    <p>&copy; 2018</p>
  </footer>
</div>