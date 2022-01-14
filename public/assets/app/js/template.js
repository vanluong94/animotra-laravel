let mItems = document.querySelectorAll('.m-collection--big .m-item');
mItems.forEach((item) => {
    item.onmouseenter = function() {
        item.classList.add('hovering');
    }
    item.onmouseleave = function() {
        item.classList.remove('hovering')
        item.classList.add('leaving');
        
        setTimeout(() => {
            item.classList.remove('leaving');   
        }, 300)
    }
})