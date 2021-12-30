const aCommon = {
    alert(msg, type) {

        let bg = type == 'success' ? 'bg-success' : 'bg-danger';
        let icon = type == 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
    
        let $alert = jQuery(`
            <div data-delay="2000" data-animation="false" aria-atomic="true" aria-live="assertive" role="alert" class="toast">
                <div class="toast-body ${bg} text-white">
                    <div class="d-flex align-items-center">
                        <div class="toast-body-icon mr-2"><i class="${icon}"></i></div>
                        <div class="toast-body-content mr-2">${msg}</div>
                        <button type="button" class="ml-auto close text-white" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        `);
    
        $alert.appendTo('body')
        $alert.toast('show').on('hidden.bs.toast', function () {
            setTimeout(() => {
                $alert.remove();
            }, 5000)
        });
    },
    deleteModal(type, name, url){

        let modalEl = document.getElementById('confirmDeleteModal');
        let modal = new bootstrap.Modal(modalEl)

        let objecTypeEl  = modalEl.querySelector('.object-type');
        let objectNameEl = modalEl.querySelector('.object-name');
        let objectURLEl  = modalEl.querySelector('.object-delete-url');
        
        objecTypeEl.innerText  = type;
        objectNameEl.innerText = name;
        objectURLEl.href       = url + '?_token=' + document.querySelector('meta[name="csrf-token"]').content;
        
        modal.show();

    },
    appendLoading($el) {
        $el.addClass('loading-object');
        $el.append('<div class="spinner"><div class="spinner-border" role="status"></div></div>');
    },
    removeLoading($el) {
        $el.find('.spinner').remove();
        $el.removeClass('loading-object');
    },
}  