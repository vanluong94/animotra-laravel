jQuery(function($){

    $(document).ready(function(){

        let $userRating = $('#userRating');
        if( $userRating.length ){
            $userRating.rating({
                hoverOnClear: false,
                theme: 'krajee-fas',
                containerClass: 'is-star'
            }).on('rating:change', function(event, value, caption) {
                $.ajax({
                    url: ajaxUrls.rating,
                    method: 'post', 
                    data: {
                        rate: value,
                        _token: appUtils.getCsrfToken()
                    }, 
                });
            });
        }
    
        $('#mangaRating').rating({
            displayOnly   : true,
            step          : 0.5,
            showCaption   : false,
            hoverOnClear  : false,
            theme         : 'krajee-fas',
            containerClass: 'is-star'
        });
    
        $('[data-action="collection-toggle"]').each(function(i,e) {
            $(e)
                .on('click', collectionToggleClick)
                .on('mouseenter', collectionToggleBtnHoverOn)
                .on('mouseleave', collectionToggleBtnHoverOut)
        })
    
        function collectionToggleClick(e) {

            e.preventDefault();

            let $this = $(this);
            let isAdded = $this.hasClass('added');
            let $icon = $this.find('i');
            let animate = $this.data('animate');
            
            $icon.attr('class', isAdded ? $this.data('add-icon') : $this.data('added-icon'));
            $this.toggleClass('added', !isAdded);

            if(!isAdded) {
                appUtils.animateCSS($icon.get(0), animate)
            } else {
                appUtils.animateCSS($icon.get(0), 'headShake');
            }

            $.ajax({
                url: ajaxUrls.userCollectionToggle,
                method: 'post',
                data: {
                    manga_id: $this.data('manga'),
                    type: $this.data('collection'),
                    _token: appUtils.getCsrfToken()
                },
            });
        }

        function collectionToggleBtnHoverOn() {
            let icon = this.querySelector('i');
            if (icon && !icon.classList.contains('animate__pulse')) {
                icon.classList.add('animate__animated', 'animate__pulse', 'animate__infinite');
            }
        }

        function collectionToggleBtnHoverOut() {
            let icon = this.querySelector('i');
            if (icon && icon.classList.contains('animate__pulse')) {
                icon.classList.remove('animate__animated', 'animate__pulse', 'animate__infinite');
            }
        }
    });

});