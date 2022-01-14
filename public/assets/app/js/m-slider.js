document.querySelectorAll('.glider-contain').forEach( (e) => {
	let glider = e.querySelector('.glider');
	if (glider && glider.dataset.glider){
		let opts = JSON.parse(glider.dataset.glider);

		if (opts.arrows) {
			opts.arrows.prev = e.querySelector(opts.arrows.prev);
			opts.arrows.next = e.querySelector(opts.arrows.next);
		}
		
		let g = new Glider(glider, opts);
		if(opts.autoplay) {
			sliderAuto(g, 4000)
		}
	}
} );

function sliderAuto(slider, miliseconds) {
	const slidesCount = slider.track.childElementCount;
	let slideTimeout = null;
	let nextIndex = 1;
	
	function slide () {
		slideTimeout = setTimeout(
			function () {
				if (nextIndex >= slidesCount ) {
					nextIndex = 0;
				}
				slider.scrollItem(nextIndex++);
			},
			miliseconds
		);
	}
	
	slider.ele.addEventListener('glider-animated', function() {
		window.clearInterval(slideTimeout);
		slide();
	});
	
	slide();
}
	
