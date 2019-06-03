<?php if(!isset($results)): ?>
<p>No Posts found</p>
<?php else: ?>
<?php foreach ($results as $result):?>
<!-- Blog Post -->
<article class="post">
  <div class="card mb-4">
    <img class="card-img-top" src="<?php echo base_url('images/blog/'.$result->path.$result->gemstone); ?>"
      alt="<?php echo $result->title; ?>">
    <div class="card-body">
      <h2 class="card-title"><?php echo $result->title; ?></h2>
      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla?
        Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus,
        veniam magni quis!</p>
      <a href="<?php echo base_url('blog/'.$result->url); ?>" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
      Posted on <?php echo $result->newdate; ?> by
      <a href="#"><?php echo $result->author; ?></a>
    </div>
  </div>
</article>
<?php endforeach; ?>
<?php endif;?>

<!-- Pagination -->
<div class="my-4">
  <nav aria-label="Page navigation example">
    <?php if(!is_null($links)):  ?>
    <?php echo $links; ?>
    <?php endif; ?>
  </nav>
</div>