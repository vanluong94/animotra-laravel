@push('headerScripts')
    <link rel="stylesheet" href="/assets/admin/css/chapter.css">
    <script src="/assets/vendor/Sortable.min.js"></script>
@endpush

{{-- CHAPTER LIST CONTENT --}}
<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Chapter Details</h6>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.manga.chapter.save', $manga->id) }}" id="chapterForm" method="POST" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="id" value="{{ $id ?? '' }}">

            <div class="row">
                {{-- chapter name --}}
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Chapter Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $name ?? '' }}" required>
                    </div>    
                </div>

                {{-- chapter extend name --}}
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Chapter Extend Name</label>
                        <input type="text" class="form-control" name="extend_name" value="{{ $extendName ?? '' }}">
                    </div>    
                </div>

                {{-- chapter coin --}}
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Chapter Coin</label>
                        <input type="number" class="form-control" name="coin" min="0" required  value="{{ $coin ?? '' }}">
                    </div>    
                </div>

                {{-- chapter date --}}
                <div class="col-md-6 col-lg-3">
                    <div class="form-group">
                        <label>Release Datetime</label>
                        <input type="datetime-local" class="form-control" name="released_at" value="{{ $release ?? '' }}">
                    </div>    
                </div>

            </div>

            <hr> 

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Chapter Images</label>

                        <ul class="chapter-images" id="chapterImagesList">

                            @if (isset($images))
                                @foreach ($images as $i => $image)
                                    <li class="chapter-img img-placeholder has-img">
                                        <div class="wrapper" style="background-image:url('{{ Storage::url($image) }}')">
                                            <div class="page-index"></div>
                                            <div class="page-delete">&times;</div>
                                            <input type="hidden" name="images[]" value="{{ $image }}">
                                        </div>
                                    </li>
                                @endforeach
                            @endif

                            <li class="chapter-img img-placeholder img-file-input">
                                <div class="wrapper">
                                    
                                    <label>
                                        <i class="fas fa-plus fa-4x"></i>
                                        <input type="file" id="chapterFilesInput" multiple accept=".jpeg,.jpg,.png" {{ isset( $id ) ? '' : 'required' }}>
                                    </label>

                                </div>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-right">

                    @if (isset($chapter))
                        <a class="btn btn-primary btn-icon-split" href="{{ $chapter->getViewUrl() }}">
                            <span class="icon text-white-50">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="text text-center flex-grow-1">View</span>
                        </a>
                    @endif

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

<script>


    jQuery(function($){

        var _URL = window.URL || window.webkitURL; 

        let $form = $('#chapterForm');
        let chapterImages = [];
        let chapterFiles = [];

        let $inputFile       = $('#chapterFilesInput');
        let $inputLi         = $inputFile.parents('li');
        

        $inputFile.on('change', function(){
            if(this.files) {
                chapterFiles = [...chapterFiles, ...this.files];

                for(let file of this.files) {

                    let $li = $(`
                        <li class="chapter-img img-placeholder has-img has-file">
                            <div class="wrapper" style="background-image:url('${_URL.createObjectURL(file)}')">
                                <div class="page-index"></div>
                                <div class="page-delete">&times;</div>
                                <input type="hidden" name="images[]" value="file">
                                <input type="file" name="files[]">
                            </div>
                        </li>
                    `);

                    // binding delete click
                    $li.find('.page-delete').on('click', deleteImage)
                        
                    // assign file
                    let container = new DataTransfer(); 
                    container.items.add(file);
                    $li.find('input[type="file"][name="files[]"]').get(0).files = container.files;

                    $inputLi.before($li);
                }

                pageListInit();
            }

            this.value = '';
        })
        
    });

    let chapterImgsListEl = document.getElementById('chapterImagesList');
    let chapterFilesInput = document.getElementById('chapterFilesInput');

    function deleteImage() {
        this.parentNode.parentNode.remove();
        pageListInit();
    }

    function pageListInit() {
        let chapterImgs = chapterImgsListEl.querySelectorAll('li.chapter-img.has-img');
        chapterImgs.forEach((el, i) => {
            // if (el.classList.contains('has-file')) {
            //     el.querySelector('input[name="images[]"]').value = i; // index of file in files[]
            // }
            el.querySelector('.page-index').innerText = i + 1;
            el.querySelector('.page-delete').onclick = deleteImage;
        })

        chapterFilesInput.required = chapterImgs.length ? false : true;
    }

    pageListInit();

    new Sortable(chapterImgsListEl, {
        animation: 150,
        ghostClass: 'img-ghost',
        onEnd: function() {
            pageListInit();
        }
    });

</script>