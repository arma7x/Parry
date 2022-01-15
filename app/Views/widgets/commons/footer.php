    <div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color:rgba(0,0,0,0.5)!important;">
          <div class="modal-body">
            <div class="spinner-grow text-danger position-fixed top-50 start-50" style="width: 3rem; height: 3rem;" role="status"></div>
          </div>
        </div>
      </div>
    </div>
    <footer class="mt-auto text-white-50">
      <p class="m-0 p-0">Page rendered in {elapsed_time} seconds. Environment: <?= ENVIRONMENT ?>. &copy; <?= date('Y') ?></p>
    </footer>
