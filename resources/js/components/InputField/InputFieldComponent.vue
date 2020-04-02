<template>
	<div id="inputfield" class="row">
		<model-select v-if="isNotUser" class="col-2" :options="options" v-model="item" placeholder="select item"/>

		<input type="text" class="form-control col-8 pr-1" name="message" placeholder="message">
		<button type="submit" class=" col-2 btn btn-primary">send</button>
	</div>

</template>

<script>
import { ModelSelect } from 'vue-search-select'

export default {
	data () {
		return {
			isNotUser: true,
			options: [
				{ value: '1', text: 'aa' + ' - ' + '1' },
				{ value: '2', text: 'ab' + ' - ' + '2' },
				{ value: '3', text: 'bc' + ' - ' + '3' },
				{ value: '4', text: 'cd' + ' - ' + '4' },
				{ value: '5', text: 'de' + ' - ' + '5' }
			],
			item: {
				value: '',
				text: ''
			},
		}
	},
	methods: {
		reset () {
			this.item = {}
		},
		selectFromParentComponent1 () {
			// select option from parent component
			this.item = this.options[0]
		},
	},
	components: {
		ModelSelect
	}
}
</script>
