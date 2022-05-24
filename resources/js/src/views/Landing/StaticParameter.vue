<template>
    <b-row class="m-0">
       
        <b-col lg="3" md="auto" class="p-0">
            <b-form-group>
                <ValidationProvider name="key" rules="required" v-slot="{ errors }">
                    <b-form-input name="key" placeholder=" Static Parameter Key" 
                        v-model="static_param.key"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>        
        </b-col>
        <b-col lg="3" md="auto" class="pl-2 p-0">
             <b-form-group>
                 <ValidationProvider name="value" rules="required" v-slot="{ errors }">
                    <b-form-input name="value" placeholder="Static Parameter Value" 
                        v-model="static_param.value"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>        
        </b-col>
       
        <b-col lg="1" md="auto">
            <button type="button" @click="removeStaticParam(paramCounter)" data-action-type="remove" class="btn btn-default text-danger" >
                <i class="fa fa-trash"></i>
            </button> 
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name:'StaticParameter',
        props: ['paramCounter','static_param'],
        methods: {
            removeStaticParam(paramCounter) {
                this.$emit('removeStaticParam', paramCounter)
            }
        }
    }
</script>