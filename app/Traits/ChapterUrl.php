<?php

namespace App\Traits;

trait ChapterUrl {

    public function getAdminEditUrl() {
        return route('admin.manga.chapter.edit', [ 
            'chapter' => $this->id, 
            'id' => $this->manga->id 
        ]);
    }

    public function getViewUrl() {
        return route('chapter.view', [
            'slug' => $this->manga->slug,
            'chapter' => $this->slug
        ]);
    }

    public function getPurchaseUrl() {
        return route('chapter.purchase', [ 
            'chapter' => $this->slug, 
            'slug' => $this->manga->slug 
        ]);
    }
    
}
