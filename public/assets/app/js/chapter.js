jQuery(function($){

    const readingNav = {

        $chapPrevBtn     : $('#chapterPrev'),
        $chapNextBtn     : $('#chapterNext'),
        $chaptersDropdown: $('#chaptersDropdown'),

        $pagePrevBtn  : $('#pagePrev'),
        $pageNextBtn  : $('#pageNext'),
        $pagesDropdown: $('#pagesDropdown'),

        $theImg: $('#theImage'),

        currentPage: 1,

        init() {
            this.$chaptersDropdown.on('change', () => this.onChapterChanged());
            this.$chapNextBtn.on('click', () => this.goNextChapter());
            this.$chapPrevBtn.on('click', () => this.goPrevChapter());

            this.$pagesDropdown.on('change', () => this.onPageChanged())
            this.$pageNextBtn.on('click', () => this.goNextPage())
            this.$pagePrevBtn.on('click', () => this.goPrevPage())
        },

        onChapterChanged() {
            window.location = this.$chaptersDropdown.val();
        },

        onPageChanged() {
            this.goPage(this.$pagesDropdown.val());
        },

        goPage(page) {
            let pageIndex = page - 1;
            if (chapterImgs[pageIndex]) {
                this.currentPage = page;
                this.$theImg.attr('src', chapterImgs[pageIndex])
            }
        },

        syncCurrentPage() {
            this.$pagesDropdown.val(this.currentPage);
        },

        hasPage(page) {
            let pageIndex = page - 1;
            return chapterImgs[pageIndex] ? true : false;
        },

        goNextPage() {
            this.goPage(this.currentPage + 1);
            this.syncCurrentPage();
        },

        goPrevPage() {
            this.goPage(this.currentPage -1);
            this.syncCurrentPage();
        },

        goPrevChapter() {
            let $selected = this.$chaptersDropdown.find('option:selected');
            let $prevChap = $selected.prev();

            if ($prevChap.length) {
                $prevChap.prop('selected', true);
                this.onChapterChanged();
            }
        },

        goNextChapter() {
            let $selected = this.$chaptersDropdown.find('option:selected');
            let $nextChap = $selected.next();
            
            if ($nextChap.length) {
                $nextChap.prop('selected', true);
                this.onChapterChanged();
            }
        }
    }
    
    readingNav.init();
})