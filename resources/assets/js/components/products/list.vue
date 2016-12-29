<template lang="html">
	<div class="container">
		<h2>Products</h2>

		<div class="mbot20">
			<a href="#" class="btn btn-primary">
				<i class="fa fa-plus"></i>
				Add Product
			</a>

			<form class="form-inline pull-right">

			</form>
		</div>

		<div class="box" v-for="product in products">
			<div class="box-body">

				<div class="row">
					<div class="col-md-2">
						<img class="img img-responsive" :src="product.picture"/>
					</div>
					<div class="col-md-10">
						<div class="pull-right">
							<div class="btn-group">
								<a class="btn btn-default" href="#">
									<i class="fa fa-pencil"></i>
									Edit
								</a>
								<button class="btn btn-default">
									<i class="fa fa-trash"></i>
									Delete
								</button>
							</div>
						</div>

						<h4>{{ product.name }}</h4>

						<hr>

						<p>{{ product.description }}</p>

						<div class="row">
							<div class="col-md-4 separate-col">
								<label>Buy Price</label>
								<p>{{ product.buy_price }}</p>
							</div>
							<div class="col-md-4 separate-col">
								<label>Sell Price</label>
								<p>{{ product.sell_price }}</p>
							</div>
							<div class="col-md-4">
								<label>Margin</label>
								<p>{{ product.sell_price - product.buy_price }}</p>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data () {
		return {
			products: []
		}
	},

	mounted () {
		this.$http.get('/test').then(function (data) {
			console.log(data)
			this.products = data.data
		})
	}
}
</script>

<style lang="css">
</style>
