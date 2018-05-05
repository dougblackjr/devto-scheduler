<template>
	<aside class="wait-list-card" draggable="true">
		<h2>{{ title }} ~ <small>{{ dateSinceCreated }}</small></h2>
	</aside>
</template>

<script>
	const moment = require('moment');

	export default {
		props: [
			'inid',
			'intitle',
			'increateddate'
		],
		data() {
			return {
				id: this.inid,
				title: this.intitle,
				createdDate: this.increateddate
			}
		},
		computed: {
			dateSinceCreated() {
				let now = moment(),
					date = moment(this.createdDate),
					diff = now.diff(date, 'minutes')

				return diff + " " + (diff == 1 ? 'minute' : 'minutes')
			}
		},
		methods: {

		},
		mounted() {
			console.log('APpt Modal is on!')
			console.log('props', this.id, this.title)
		}
	}
</script>

<style scoped>
	.wait-list-card {
		background-color: #89b4ce;
		border-radius: 10px;
		border: 1px solid #4e4e4e;
		text-align: center;
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