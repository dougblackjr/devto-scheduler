<template>
	<aside class="wait-list-card">
		Title
	</aside>
</template>

<script>
	const moment = require('moment');

	import datetime from 'vuejs-datetimepicker';

	export default {
		components: {datetime},
		props: [
			'inid',
			'intitle',
			'increateddate',
			'instart',
			'inend'
		],
		data() {
			return {
				id: this.inid,
				title: this.intitle,
				createdDate: this.increateddate,
				start: this.instart,
				end: this.inend
			}
		},
		methods: {

		},
		mounted() {
			console.log('APpt Modal is on!')
			console.log('props', this.resources)
		}
	}
</script>

<style scoped>