<h1 class="h2 text-dark mt-4 mb-4">会社情報の一覧</h1>
<a href="new.php" class= "btn btn-primary mb-4">会社情報を登録する</a>
<main>
  <?php if (count($book_logs) > 0) : ?>
  <?php foreach ($book_logs as $book_log) : ?>

  <section class= "card shadow-sm mb-4">
    <div class="card-body">
      <h2 class="card-title h4 mb-3">
        <?php echo escape($book_log['title']) ?>
      </h2>
      <div>著者名：
        <?php echo escape($book_log['author']) ?>
      </div>
      <div>読書状況：
        <?php echo escape($book_log['status']) ?>
      </div>
      <div>評価：
        <?php echo escape($book_log['assessment']) ?>
      </div>
      <div>感想：
        <?php echo escape($book_log['impression']) ?>
      </div>
    </div>
  </section>
  <?php endforeach; ?>
  
  <?php else : ?>
    <p>読書ログが登録されていません。</p>
  <?php endif; ?>
</main>