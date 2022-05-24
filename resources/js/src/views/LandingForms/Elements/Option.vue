<template>
    <b-row class="m-0">
        <b-col lg="2" class="pr-0">
            <b-form-group class="d-inline">       
                <b-form-checkbox name="valid" class="mt-2"
                    v-model="field.options[optionCounter].valid"
                    value="1"
                    >Valid
                </b-form-checkbox>            
            </b-form-group>         
        </b-col>
        <b-col lg="9" class="pl-0" >
            <b-form-group>
                <ValidationProvider :name="'option'+optionCounter" rules="required" v-slot="{ errors }">
                    <b-form-input name="option" placeholder="Option" 
                        v-model="field.options[optionCounter].value"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>
        </b-col>
        <b-col lg="1">
            <button type="button" @click="removeOption(counter, optionCounter)" data-action-type="remove" class="btn btn-default text-danger px-1 float-right" >
                <i class="fa fa-trash"></i>
            </button> 
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name:'Option',
        props: ['counter','optionCounter','sectionCounter','field'],
        methods: {
            removeOption(counter, optionCounter) {
                this.$emit('removeOption',counter, optionCounter)
            }
        }
    }
</script>