<div class="modal fade" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="/album/edit" id="album-form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Добавить новый альбом</h5>
          <button type="button" class="btn-close" onclick="album.closeModal()" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="album-name" class="form-label">Название альбома</label>
              <input name="album-name" type="text" class="form-control" id="album-name" required>
          </div>
          <div>
              <label for="album-tieser" class="form-label">Описание альбома</label>
              <textarea name="album-tieser" class="form-control" id="album-tieser" placeholder="Несколько слов о чем альбом"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input name="album-id" type="hidden" id="album-id" />
          <button type="button" class="btn btn-secondary" onclick="album.closeModal()">Закрыть</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="/album/images/edit" id="image-form">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Редактировать изображение</h5>
          <button type="button" class="btn-close" onclick="albumImage.closeModal()" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="image-caption" class="form-label">Название изображения</label>
              <input name="image-caption" type="text" class="form-control" id="image-caption" required>
          </div>
          <div>
              <label for="image-description" class="form-label">Описание изображения</label>
              <textarea name="image-description" class="form-control" id="image-description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input name="image-id" type="hidden" id="image-id" />
          <input name="redirect" type="hidden" id="redirect" />
          <button type="button" class="btn btn-secondary" onclick="albumImage.closeModal()">Закрыть</button>
          <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="singleImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="container-fluid">
            <div class="row align-items-stretch">
              <div class="col-12 col-lg-6" id="image-preview"></div>
              <div class="col-12 col-lg-6 position-relative d-flex flex-column">
                <div id="image-info" class="d-flex flex-column flex-grow-1"></div>
                <div class="comment-form p-3 mt-auto">
                  <form action="" id="comment-form">
                    <input name="comment-author" id="comment-name" class="form-control form-control-sm mb-1" type="text" placeholder="Имя" required />
                    <textarea name="comment-text" id="comment-text" class="form-control form-control-sm mb-1" placeholder="Комментарий" required></textarea>
                    <input name="comment-image" id="comment-image" type="hidden" />
                    <button class="btn btn-sm btn-primary" type="button" onclick="comment.add()">Добавить комментарий</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>