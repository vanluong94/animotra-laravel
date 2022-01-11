document.querySelectorAll('.glider-contain').forEach( (e) => {
	let glider = e.querySelector('.glider');
	if (glider && glider.dataset.glider){
		let opts = JSON.parse(glider.dataset.glider);

		if (opts.arrows) {
			opts.arrows.prev = e.querySelector(opts.arrows.prev);
			opts.arrows.next = e.querySelector(opts.arrows.next);
		}
		new Glider(glider, opts);
	}
} );