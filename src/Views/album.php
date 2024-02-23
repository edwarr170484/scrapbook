<?php include(__DIR__ . "/common/header.php");?>
<main class="flex-shrink-0 flex-grow-1">
  <?php if($album){?>
    <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading"><?php echo $album["name"];?></h1>
          <p class="lead text-muted"><?php echo $album["tieser"];?></p>
          <form action="" method="POST" enctype="multipart/form-data">
              <input name="attachment[]" type="file" id="attachment" multiple />
          </form>
        </div>
    </section>
    <?php if($album["images"]){?>
      <div class="album py-5 bg-light">
        <div class="container">
          <div class="row">
            <?php foreach($album["images"] as $image){?>
              <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                  <a href="#">
                    <img class="card-img-top" data-src="" src="<?php echo $image['path'];?>" data-holder-rendered="true" style="height: 225px; width: 100%; display: block;">
                  </a>
                  <div class="card-body">
                    <p class="card-text"><?php echo $image['caption'];?></p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                      <button type="button" class="btn btn-sm btn-outline-secondary" title="Редактировать" onclick="albumImage.edit()"><i class="fas fa-edit"></i></button>
                      <button type="button" class="btn btn-sm btn-outline-secondary" title="Удалить" onclick="albumImage.delete()"><i class="fas fa-trash-alt"></i></button>
                      </div>
                      <small class="text-muted"><?php echo $image["date_added"]->format("d.m.Y H:i");?></small>
                    </div>
                  </div>
                </div>
              </div>
            <?php }?>
          </div>
        </div>
      </div>
    <?php }?>
  <?php }else{?>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <img src="/assets/images/not-found.png" alt="Something not found" />
    </div>
  <?php }?>
</main>
<?php include(__DIR__ . "/common/footer.php");?>