$( document ).ready(function() {

	window.addEventListener('popstate', function(event) {
		
		if (event.state !== null) {

			var action = event.state["action"];
		
			if (action == "mostfaved") {		
				mostfaved();
				$('#okienko').html('');
				$("#okienko").hide();
				$("#okienko_overlay").hide();
				$('body').removeClass("overflow-f");
			}
								
			if (action == "okno") {		
				var prod_id = event.state["id"];
				okno(prod_id);
			}
		
			if (action == "sub") {
				var asub = event.state["asub"];
				var menu = event.state["menu"];
				var r2 = event.state["r2"];
				var plec = event.state["plec"];
				var stores = event.state["stores"];
				var brands = event.state["brands"];
				var podkat = event.state["podkat"];
				var page = event.state["page"];
				
				$('#okienko').html('');
				$("#okienko").hide();
				$("#okienko_overlay").hide();
				$('body').removeClass("overflow-f");
				
				filter_sub(asub, menu, r2, plec, page);
			}	
		
			if (action == "search") {
				var st = event.state["st"];
				$('#okienko').html('');
				$("#okienko").hide();
				$("#okienko_overlay").hide();
				$('body').removeClass("overflow-f");
				search(st);
			}
			
			if (action == "filter_search") {
				var st = event.state["st"];
				var stores = event.state["stores"];
				var brands = event.state["brands"];
				var podkat = event.state["podkat"];
				var page = event.state["page"];
				$('#okienko').html('');
				$("#okienko").hide();
				$("#okienko_overlay").hide();
				$('body').removeClass("overflow-f");
				filter(page);
			}
			
			if (action == "likes") {
				$('#okienko').html('');
				$("#okienko").hide();
				$("#okienko_overlay").hide();
				$('body').removeClass("overflow-f");
				user_acc();
			}
			
		} else {
			console.log("Brak historii.")
		}
		
		
    });
	
})