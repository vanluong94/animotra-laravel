{{-- CHAPTER LIST CONTENT --}}
<div id="chaptersList">
    <div class="card mb-4">
        <!-- Card Header - Accordion -->
        <div href="#collapseCardExample" class="card-header py-3 d-flex flex-row align-items-center justify-content-between" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Chapter 1</h6>

            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </div>

        </div>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample" style="">
            <div class="card-body">
                <form action="{{ route('ajax.chapter.save') }}" class="chapter-form">

                    @csrf
                    <input type="hidden" name="manga_id">
                    <input type="hidden" name="chapter_id">

                    <div class="row">
                        {{-- chapter name --}}
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Chapter Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>    
                        </div>

                        {{-- chapter extend name --}}
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Chapter Extend Name</label>
                                <input type="text" class="form-control" name="extend_name">
                            </div>    
                        </div>

                        {{-- chapter coin --}}
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Chapter Coin</label>
                                <input type="number" class="form-control" name="coin" min="0" required>
                            </div>    
                        </div>

                        {{-- chapter date --}}
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <label>Release Datetime</label>
                                <input type="datetime-local" class="form-control" value="">
                            </div>    
                        </div>

                    </div>

                    <hr> 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Chapter Images</label>

                                <ul class="chapter-images">
                                    <li class="chapter-img img-placeholder img-file-input">
                                        <div class="wrapper">
                                            
                                            <label>
                                                <i class="fas fa-plus fa-4x"></i>
                                                <input type="file" class="chapter-files-input" multiple accept=".jpeg,.jpg,.png" required>
                                            </label>

                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Save</span>
                            </button>
                            <button type="submit" class="btn btn-danger btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

{{-- CHAPTER LIST BUTTON --}}
<div class="text-center">
    <button class="btn btn-primary btn-icon-split" id="addNewChapter">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i> 
        </span>
        <span class="text">Add New Chapter</span>
    </button>
</div>

<script>
    jQuery(function($){

        var _URL = window.URL || window.webkitURL; 
        
        $('.chapter-form').each(function(i,e){
            chapterFormInit($(e));
        });

        function chapterFormInit($form) {
            let chapterImages = [];
            let chapterFiles = [];

            let $inputFile       = $form.find('input[type="file"].chapter-files-input')
            let $inputLi         = $inputFile.parents('li');
            let $chapterImgsList = $form.find('.chapter-images');

            $inputFile.on('change', function(){
                if(this.files) {
                    chapterFiles = [...chapterFiles, ...this.files];

                    for(let file of this.files) {
                        $inputLi.before(`
                            <li class="chapter-img img-placeholder has-img">
                                <div class="wrapper" style="background-image:url('${_URL.createObjectURL(file)}')">
                                </div>
                            </li>
                        `);
                    }
                }
            })

            $form.on('submit', function(e){
                e.preventDefault();

                let chapterFD = new FormData(this);
                $.ajax({
                    url: '{{ route('ajax.chapter.save') }}' + '?_token=' + chapterFD.get('_token'),
                    method: 'post',
                    data: chapterFD, 
                    processData: false,
                })
                .done(function(resp){

                    let imgAjaxes = chapterFiles.map((file) => {

                        let formData = new FormData();
                        formData.append('file', chapterFiles[0]);
                        formData.append('chapter_id', resp.data.chapter_id);

                        return $.ajax({
                            url: '{{ route('ajax.chapter.upload') }}',
                            method: 'post',
                            contentType: false,
                            processData: false,
                            enctype: 'multipart/form-data',
                            data: formData, 
                        });

                    });

                    return $.when( ...imgAjaxes );
                })
                .done((data) => {
                    console.log('completed', data);
                })
                .fail(function(xhr, status, err){
                    console.log(err);
                })

            })
        }   

        let chapterImages = [];
        
        let $addNewChapterBtn = $('#addNewChapter');

        $addNewChapterBtn.on('click', (e) => {
            e.preventDefault();

        })
    });
</script>