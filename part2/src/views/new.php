
  <h1 class="h2 text-dark mt-4 mb-4">読書ログの登録</h1>
    <form action="create.php" method="POST">
      <?php if(count($errors)) : ?>
        <ul class="text-danger">
          <?php foreach($errors as $error) : ?>
            <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="form-group">
        <label for="title">書籍名</label>
        <input type="text" name="title" id="title" value="<?php echo $reviews['title'] ?>">
      </div>
      <div class="form-group">
        <label for="author">著者名</label>
        <input type="text" name="author" id="author" value="<?php echo $reviews['author'] ?>">
      </div>
      <div class="form-group">
        <label>読書状況</label>
    
        <input type="radio" name="status" id="status1" value="未読" <?php echo ($reviews['status'] ==='未読')? 'checked' : '';?>>
        <label for="status">未読</label>
        <input type="radio" name="status" id="status2" value="読んでいる" <?php echo ($reviews['status'] ==='読んでいる')? 'checked' : '';?>>
        <label for="status">読んでいる</label>
        <input type="radio" name="status" id="status3" value="読了" <?php echo ($reviews['status'] ==='読了')? 'checked' : '';?>>
        <label for="status">読了</label>
      </div>
      <div class="form-group">
        <label for="assessment">評価</label>
        <input type="number" name = "assessment" id="assessment" min="0" max="5" value="<?php echo $reviews['assessment'] ?>">
      </div>
      <div class="form-group">
        <label for="impression">感想</label>
        <textarea type="text" id="impression" name="impression" cols="50" rows="10" value="<?php echo $reviews['impression'] ?>"></textarea>
      </div>
      <button type = "submit">送信</button>
    </form>
