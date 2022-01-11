@php
    $is_added = $manga->isBookmarked( $collection );
    $class .= $is_added ? ' added ' : '';
@endphp
<div 
    class="{{ $class }}" 

    data-added-icon="{{ $addedIcon }}" 
    data-add-icon="{{ $addIcon }}"
    data-animate="{{ $animate }}"

    @auth
        data-action="collection-toggle" 
        data-manga="{{ $manga->id }}" 
        data-collection="{{ $collection }}" 
    @endauth

    @guest
        data-toggle="tooltip" 
        data-placement="top" 
        title="Login is required"
    @endguest   
>
    <div class="btn__icon"><i class="{{ $is_added ? $addedIcon : $addIcon }}"></i></div>
    <div class="btn__text"><span class="text-uppercase">{{ $text }}</span></div>
</div>