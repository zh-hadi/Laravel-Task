(function(){
  // Add to Cart Interaction 

  var cart = document.getElementsByClassName('js-cd-cart');
  //if(cart.length > 0) {
  	var cartAddBtns = document.getElementsByClassName('js-cd-add-to-cart'),
  		cartBody = cart[0].getElementsByClassName('cd-cart__body')[0],
  		cartList = cartBody.getElementsByTagName('ul')[0],
  		cartListItems = cartList.getElementsByClassName('cd-cart__product'),
  		cartTotal = cart[0].getElementsByClassName('cd-cart__checkout')[0].getElementsByTagName('span')[0],
  		cartCount = cart[0].getElementsByClassName('cd-cart__count')[0],
  		cartCountItems = cartCount.getElementsByTagName('li'),
  		cartUndo = cart[0].getElementsByClassName('cd-cart__undo')[0],
  		productId = 0, //this is a placeholder -> use your real product ids instead
  		cartTimeoutId = false,
  		animatingQuantity = false;
		initCartEvents();
		
		 
		async function fetchData() {
			const response = await fetch('http://localhost:8000/api/shop/cartinfo?user_id=' + b_user_id);
			if (!response.ok) {
				throw new Error('Network response was not ok ' + response.statusText);
			}
			return response.json();
		}
		
		fetchData()
			.then(result => {
				cart_data = result;
				if(cart_data.length !=0){
					if(animatingQuantity) return;
					var cartIsEmpty = Util.hasClass(cart[0], 'cd-cart--empty');
									//show cart
					Util.removeClass(cart[0], 'cd-cart--empty');
					for(var k=0;k<cart_data.length;k++){
						addProductManual(cart_data[k][5],cart_data[k][4],cart_data[k][6],cart_data[k][2],cart_data[k][1],cart_data[k][3]);
						updateCartCount(cartIsEmpty);
						updateCartTotal(cart_data[k][5]*cart_data[k][3], true);
						
					}
					quickUpdateCart();
				}
				
			})
			.catch(error => console.error('There was a problem with the fetch operation:', error));
		

		function initCartEvents() {
			// add products to cart
			for(var i = 0; i < cartAddBtns.length; i++) {(function(i){
				cartAddBtns[i].addEventListener('click', addToCart);
			})(i);}

			// open/close cart
			cart[0].getElementsByClassName('cd-cart__trigger')[0].addEventListener('click', function(event){
				event.preventDefault();
				toggleCart();
			});
			
			cart[0].addEventListener('click', function(event) {
				if(event.target == cart[0]) { // close cart when clicking on bg layer
					toggleCart(true);
				} else if (event.target.closest('.cd-cart__delete-item')) { // remove product from cart
					event.preventDefault();
					removeProduct(event.target.closest('.cd-cart__product'));
				}
			});

			// update product quantity inside cart
			cart[0].addEventListener('change', function(event) {
				if(event.target.tagName.toLowerCase() == 'select') {
					quickUpdateCart();
					let productId = event.target.getAttribute('data-productid');
					let userid = event.target.getAttribute('data-userid');
					let quantity = event.target.value;
					fetch('http://localhost:8000/api/shop/cartupdate', {
						method: 'POST',
						body: JSON.stringify({
							user_id: userid,
							product_id: productId,
							quantity : quantity
						}),
						headers: {
						  'Content-type': 'application/json; charset=UTF-8',
						//   'X-CSRF-TOKEN': csrfToken
						},
					  })
					.then((response) => response.json())
					.then((json) => console.log(json));
					
				}
			});

			//reinsert product deleted from the cart
			cartUndo.addEventListener('click', function(event) {
				if(event.target.tagName.toLowerCase() == 'a') {
					event.preventDefault();
					if(cartTimeoutId) clearInterval(cartTimeoutId);
					// reinsert deleted product
					var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted')[0];
					Util.addClass(deletedProduct, 'cd-cart__product--undo');
					deletedProduct.addEventListener('animationend', function cb(){
						deletedProduct.removeEventListener('animationend', cb);
						Util.removeClass(deletedProduct, 'cd-cart__product--deleted cd-cart__product--undo');
						deletedProduct.removeAttribute('style');
						quickUpdateCart();
					});
					Util.removeClass(cartUndo, 'cd-cart__undo--visible');
				}
			});
		};

		function addToCart(event) {
			event.preventDefault();
			if(animatingQuantity) return;
			var cartIsEmpty = Util.hasClass(cart[0], 'cd-cart--empty');
			//update cart product list
			addProduct(this);
			//update number of items 
			updateCartCount(cartIsEmpty);
			//update total price
			updateCartTotal(this.getAttribute('data-price'), true);
			//show cart
			Util.removeClass(cart[0], 'cd-cart--empty');
		};

		function toggleCart(bool) { // toggle cart visibility
			var cartIsOpen = ( typeof bool === 'undefined' ) ? Util.hasClass(cart[0], 'cd-cart--open') : bool;
		
			if( cartIsOpen ) {
				Util.removeClass(cart[0], 'cd-cart--open');
				//reset undo
				if(cartTimeoutId) clearInterval(cartTimeoutId);
				Util.removeClass(cartUndo, 'cd-cart__undo--visible');
				removePreviousProduct(); // if a product was deleted, remove it definitively from the cart

				setTimeout(function(){
					cartBody.scrollTop = 0;
					//check if cart empty to hide it
					if( Number(cartCountItems[0].innerText) == 0) Util.addClass(cart[0], 'cd-cart--empty');
				}, 500);
			} else {
				Util.addClass(cart[0], 'cd-cart--open');
			}
		};

		function selectLoop(quantity){
			let selectLoopStr = '';
			for(let l=1;l<20;l++){
				if(quantity===l){
					selectLoopStr += '<option selected value='+l+'>'+l+'</option>';
				}
				else{
					selectLoopStr += '<option value='+l+'>'+l+'</option>';
				}
				
			}
			return selectLoopStr;
		}

		function addProductManual(price,name,pimage,productId,userid,quantity) {
			// this is just a product placeholder
			// you should insert an item with the selected product info
			// replace productId, productName, price and url with your real product info
			// you should also check if the product was already in the cart -> if it is, just update the quantity
			// let price = target.getAttribute('data-price');
			// let name = target.getAttribute('data-name');
			// let pimage = target.getAttribute('data-pimage');
			// let productId = target.getAttribute('data-id');
			// let userid = target.getAttribute('data-userid');
			
			var productAdded = `<li
								class="cd-cart__product"
								data-productid="${productId}"
								data-userid="${userid}"
								>
								<div class="row cd-cart__details">
									<div class="col-3 cd-cart__image">
									<a href="#0"><img src="${pimage}" alt="placeholder" /></a>
									</div>
									<div class="col-7">
										<div class="row">	
										<h3 class="truncate"><a href="#0">ID: ${productId}</a></h3>
										</div>
										<div class="row">	
										<h3 class="truncate">Product Name: <a href="#0">${name}</a></h3>
										</div>
										<div class="row">	
											<div class="cd-cart__actions">
												<a href="#0" class="cd-cart__delete-item">Delete</a>
												<div class="cd-cart__quantity">
													<label for="cd-product-${productId}">Qty</label>
													<span class="cd-cart__select">
													<select
													class="reset"
													id="cd-product-${productId}"
													data-productid="${productId}"
													data-userid="${userid}"
													name="quantity">
													${selectLoop(quantity)}
													</select>
													<svg class="icon" viewBox="0 0 12 12">
														<polyline
														fill="none"
														stroke="currentColor"
														points="2,4 6,8 10,4 "/>
													</svg>
													</span>
												</div>
											</div>
										</div>
									</div>	
									<div class="col-2">
										<span class="cd-cart__price">${price}</span>
									</div> 
								</div>
								</li>`;
			cartList.insertAdjacentHTML('beforeend', productAdded);
			//const csrfToken = target.getAttribute('data-csrf');
			
			
		};

		function addProduct(target) {
			// this is just a product placeholder
			// you should insert an item with the selected product info
			// replace productId, productName, price and url with your real product info
			// you should also check if the product was already in the cart -> if it is, just update the quantity
			//<div class="cd-cart__image"><a href="#0"><img src="'+pimage+'" alt="placeholder"></a></div>
			let price = target.getAttribute('data-price');
			let name = target.getAttribute('data-name');
			let pimage = target.getAttribute('data-pimage');
			let productId = target.getAttribute('data-id');
			let userid = target.getAttribute('data-userid');
			var productAdded = `<li
								class="cd-cart__product"
								data-productid="${productId}"
								data-userid="${userid}"
								>
								<div class="row cd-cart__details">
									<div class="col-3 cd-cart__image">
									<a href="#0"><img src="${pimage}" alt="placeholder" /></a>
									</div>
									<div class="col-7">
										<div class="row">	
										<h3 class="truncate"><a href="#0">ID: ${productId}</a></h3>
										</div>
										<div class="row">	
										<h3 class="truncate">Product Name: <a href="#0">${name}</a></h3>
										</div>
										<div class="row">	
											<div class="cd-cart__actions">
												<a href="#0" class="cd-cart__delete-item">Delete</a>
												<div class="cd-cart__quantity">
													<label for="cd-product-${productId}">Qty</label>
													<span class="cd-cart__select">
													<select
													class="reset"
													id="cd-product-${productId}"
													data-productid="${productId}"
													data-userid="${userid}"
													name="quantity">

														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
													</select>
													<svg class="icon" viewBox="0 0 12 12">
														<polyline
														fill="none"
														stroke="currentColor"
														points="2,4 6,8 10,4 "/>
													</svg>
													</span>
												</div>
											</div>
										</div>
									</div>	
									<div class="col-2">
										<span class="cd-cart__price">${price}</span>
									</div> 
								</div>
								</li>`;
			cartList.insertAdjacentHTML('beforeend', productAdded);
			const csrfToken = target.getAttribute('data-csrf');
			fetch('http://localhost:8000/api/shop/cartsave', {
				method: 'POST',
				body: JSON.stringify({
				  product_id: productId,
				  user_id: userid,
				  quantity : 1
				}),
				headers: {
				  'Content-type': 'application/json; charset=UTF-8',
				  'X-CSRF-TOKEN': csrfToken
				},
			  })
			.then((response) => response.json())
			.then((json) => console.log(json));
			
		};

		function removeProduct(product) {
			if(cartTimeoutId) clearInterval(cartTimeoutId);
			removePreviousProduct(); // prduct previously deleted -> definitively remove it from the cart
			
			var topPosition = product.offsetTop,
				productQuantity = Number(product.getElementsByTagName('select')[0].value),
				productTotPrice = Number((product.getElementsByClassName('cd-cart__price')[0].innerText).replace('$', '')) * productQuantity;

			product.style.top = topPosition+'px';
			Util.addClass(product, 'cd-cart__product--deleted');

			//update items count + total price
			updateCartTotal(productTotPrice, false);
			updateCartCount(true, -productQuantity);
			Util.addClass(cartUndo, 'cd-cart__undo--visible');

			//wait 8sec before completely remove the item
			cartTimeoutId = setTimeout(function(){
				Util.removeClass(cartUndo, 'cd-cart__undo--visible');
				removePreviousProduct();
			}, 8000);
			let productId = product.getAttribute('data-productid');
			let userid = product.getAttribute('data-userid');
			fetch('http://localhost:8000/api/shop/cartdelete', {
				method: 'POST',
				body: JSON.stringify({
					user_id: userid,
				  	product_id: productId,
				}),
				headers: {
				  'Content-type': 'application/json; charset=UTF-8',
				//   'X-CSRF-TOKEN': csrfToken
				},
			  })
			.then((response) => response.json())
			.then((json) => console.log(json));
		};

		function removePreviousProduct() { // definitively removed a product from the cart (undo not possible anymore)
			var deletedProduct = cartList.getElementsByClassName('cd-cart__product--deleted');
			if(deletedProduct.length > 0 ) deletedProduct[0].remove();
		};

		function updateCartCount(emptyCart, quantity) {
			if( typeof quantity === 'undefined' ) {
				var actual = Number(cartCountItems[0].innerText) + 1;
				var next = actual + 1;
				
				if( emptyCart ) {
					cartCountItems[0].innerText = actual;
					cartCountItems[1].innerText = next;
					animatingQuantity = false;
				} else {
					Util.addClass(cartCount, 'cd-cart__count--update');

					setTimeout(function() {
						cartCountItems[0].innerText = actual;
					}, 150);

					setTimeout(function() {
						Util.removeClass(cartCount, 'cd-cart__count--update');
					}, 200);

					setTimeout(function() {
						cartCountItems[1].innerText = next;
						animatingQuantity = false;
					}, 230);
				}
			} else {
				var actual = Number(cartCountItems[0].innerText) + quantity;
				var next = actual + 1;
				
				cartCountItems[0].innerText = actual;
				cartCountItems[1].innerText = next;
				animatingQuantity = false;
			}
		};

		function updateCartTotal(price, bool) {
			cartTotal.innerText = bool ? (Number(cartTotal.innerText) + Number(price)).toFixed(2) : (Number(cartTotal.innerText) - Number(price)).toFixed(2);
		};

		function quickUpdateCart() {
			var quantity = 0;
			var price = 0;

			for(var i = 0; i < cartListItems.length; i++) {
				if( !Util.hasClass(cartListItems[i], 'cd-cart__product--deleted') ) {
					var singleQuantity = Number(cartListItems[i].getElementsByTagName('select')[0].value);
					quantity = quantity + singleQuantity;
					
					price = price + singleQuantity*Number((cartListItems[i].getElementsByClassName('cd-cart__price')[0].innerText).replace('$', ''));
				}
			}

			cartTotal.innerText = price.toFixed(2);
			cartCountItems[0].innerText = quantity;
			cartCountItems[1].innerText = quantity+1;
		};
  //}
})();