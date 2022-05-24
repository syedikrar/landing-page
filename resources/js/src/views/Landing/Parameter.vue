<template>
    <b-row class="m-0">
       
        <b-col lg="4" md="auto" class="p-0">
            <b-form-group>
                <ValidationProvider name="key" rules="required" v-slot="{ errors }">
                    <b-form-input name="key" placeholder="Parameter" 
                        v-model="param.key"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>        
        </b-col>
       
        <b-col lg="1" md="auto">
            <button type="button" @click="removeParam(paramCounter)" data-action-type="remove" class="btn btn-default text-danger" >
                <i class="fa fa-trash"></i>
            </button> 
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name:'Parameter',
        props: ['paramCounter','param'],
        methods: {
            removeParam(paramCounter) {
                this.$emit('removeParam', paramCounter)
            }
        }
    }
</script>