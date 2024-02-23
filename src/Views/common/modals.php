<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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