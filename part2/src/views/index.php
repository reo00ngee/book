<h1>会社情報の一覧</h1>
<a href="new.php">会社情報を登録する</a>
<main>
  <?php if (count($book_logs) > 0) : ?>
  <?php foreach ($book_logs as $book_log) : ?>

  <section>
    <h2>
      <?php echo $book_log['title'] ?>
    </h2>
    <div>著者名：
      <?php echo $book_log['author'] ?>
    </div>
    <div>読書状況：
      <?php echo $book_log['status'] ?>
    </div>
    <div>評価：
      <?php echo $book_log['assessment'] ?>
    </div>
    <div>感想：
      <?php echo $book_log['impression'] ?>
    </div>
  </section>
  <?php endforeach; ?>
  
  <?php else : ?>
    <p>読書ログが登録されていません。</p>
  <?php endif; ?>
</main>