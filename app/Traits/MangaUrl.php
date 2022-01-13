<?php

namespace App\Traits;

trait MangaUrl {

    public function getViewURL() {
        return route('manga.view', $this->slug);
    }

    public function getAdminEditURL() {
        return route('admin.manga.edit', $this->id);
    }

    public function getAdminDeleteUrl() {
        return route('admin.manga.delete', $this->id);
    }

    public function getAdminChaptersListUrl() {
        return route('admin.manga.chapter.all', $this->id);
    }
    
}
