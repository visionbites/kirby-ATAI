<script>
export default {
	name: "AtaiButton",
	props: {
		after: String,
		before: String,
		disabled: Boolean,
		help: String,
		icon: String,
		label: String,
		required: Boolean,
		when: String,
		value: String,
	},
	data() {
		return {
			isLoading: false,
		}
	},
	methods: {
		onInput() {
			this.$emit("input", this.value);
		},
		async handleClick() {
			this.isLoading = true;
			let data = {
				image: this.$attrs["form-data"].uuid,
				lang: this.$language.code,
				page: this.$panel.view.props.model.parent
			}
			const response = await this.$api.post('/atai-image', data);
			if(!response.error_code) {
				this.value = response.alt_text;
				this.onInput();
				this.isLoading = false;
			}
		}
	}
}
</script>

<template>
	<div>
			<k-field class="k-atai-field"
							 :label="label"
							 :disabled="disabled"
							 :help="help"
							 :required="required"
							 :when="when">
				<k-button :icon="isLoading ? 'loader' : 'add'" size="xs" slot="options" variant="filled" @click="handleClick" :disabled="isLoading">
					Generate Alt-Text
				</k-button>
				<k-input
					:after="after"
					:before="before"
					:icon="icon"
					theme="field"
					type="text"
					name="textfield"
					:value="value"
					@input="onInput"/>
			</k-field>
	</div>

</template>

<style scoped>

</style>
