<style type="text/css">
	.search-section {
		position:  relative;
	}

	#search-form {
		position: absolute;
		background-color: #FAFAFA;
		padding: 10px;
		box-shadow: 1px 1px 1px rgba(45,45,45,.5);
		display: none;
		z-index: 99;
		top: 100%;
		width: 350px;
		right: 0;
	}
</style>

<li class="dropdown navbar-right search-section">
  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search by<span class="caret"></span></a>
  	<ul class="dropdown-menu">
    	<li><a href="#" search-type="price">price</a></li>
    	<li><a href="#" search-type="area">Area</a></li>
    	<li><a href="#" search-type="country">Country</a></li>
    	<li><a href="#" search-type="city">city</a></li>
    	<li><a href="#" search-type="region">region</a></li>
    	<li><a href="#" search-type="type">type</a></li>
  	</ul>
  	<div id="search-form" class="container"></div>
</li>