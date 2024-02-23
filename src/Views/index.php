<?php include(__DIR__ . "/common/header.php");?>
<main class="flex-shrink-0">
  <div class="container">
    <h1 class="mt-5 mb-3"><?php echo $header;?></h1>
    <?php if(count($albums) > 0){?>
        <ol class="list-group list-group-numbered">
            <?php foreach($albums as $album){?>
                <li class="list-group-item d-flex justify-content-between align-items-start position-relative">
                    <div class="ms-2 me-auto">
                        <a href="/album?id=<?php echo $album["id"];?>">
                            <div class="fw-bold">Альбом "<?php echo $album["name"];?>"</div>
                        </a>
                        <p><?php echo $album["tieser"];?></p>
                        <small class="text-sm text-body-secondary">Обновлен <?php $date = new \DateTime($album["date_updated"]);echo $date->format("d.m.Y");?></small>
                    </div>
                    <span class="badge bg-primary rounded-pill">Фотографий: 0</span>
                    <div class="btn-group position-absolute">
                      <button type="button" class="btn btn-sm btn-outline-secondary" title="Редактировать" onclick="album.edit(<?php echo $album['id'];?>)"><i class="fas fa-edit"></i></button>
                      <button type="button" class="btn btn-sm btn-outline-secondary" title="Удалить" onclick="album.delete(<?php echo $album['id'];?>)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </li>
            <?php }?>
        </ol>
    <?php }?>
  </div>
</main>
<?php include(__DIR__ . "/common/footer.php");?>