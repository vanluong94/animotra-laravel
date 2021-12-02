document.querySelectorAll('.glider').forEach( (e) => {
	// new Glider(e, );
	if (e.dataset.glider){
		new Glider(e, JSON.parse(e.dataset.glider));
	}
} );