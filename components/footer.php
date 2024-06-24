</div>
    </div>

    <script>
        function callToast(type,message) {
        let toast=`<div class="toast position-fixed bottom-0 end-0 p-1 m-3 text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
              ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', toast);
        $(`.toast`).toast('show');
        }
    </script>
</body>

</html>
