<template>
	<aside class="wait-list-card" draggable="true" v-bind:id='"wait-list-card-" + id' v-bind:data-id='id' v-bind:data-title='title' v-bind:data-description="description">
		<h2>{{ title }}<br /><small>{{ dateSinceCreated }}</small></h2>
	</aside>
</template>

<script>
	const moment = require('moment');

	export default {
		props: [
			'inid',
			'intitle',
			'indescription',
			'increateddate'
		],
		data() {
			return {
				id: this.inid,
				title: this.intitle,
				description: this.indescription,
				createdDate: this.increateddate
			}
		},
		computed: {
			dateSinceCreated() {
				let now = moment().utc(),
					date = moment(this.createdDate),
					diff = now.diff(date, 'minutes')
				console.log(now.format(), date.format(), diff)

				return diff + " " + (diff == 1 ? 'minute' : 'minutes')
			}
		},
		methods: {

		},
		mounted() {
			console.log('Wait list card is on!', this.id)
			$('#wait-list-card-' + this.id).draggable({
				helper: 'clone',
				revert: 'invalid',
				cursor: 'move'
			});
		}
	}
</script>

<style scoped>
	.wait-list-card {
		background-color: #89b4ce;
		border-radius: 10px;
		border: 1px solid #4e4e4e;
		text-align: center;
		margin: 1rem;
	}

	h2 {
		font-size: 1rem;
		font-weight: bold;
		padding: 2px;
	}

	small {
		font-size: 0.8rem;
	}
</style>