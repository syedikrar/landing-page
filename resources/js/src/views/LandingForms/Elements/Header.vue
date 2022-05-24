<template>
    <b-row class="m-0">
        <b-col lg="2" md="auto" class="p-0">
         <label>  Header</label>
        </b-col>
        <b-col lg="4" md="auto" class="p-0">
            <b-form-group>
                <ValidationProvider name="key" rules="required" v-slot="{ errors }">
                    <b-form-input name="key" placeholder="Key" 
                        v-model="header.key"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>        
        </b-col>
        <b-col lg="5"  md="auto" class="p-0 pl-lg-4">
            <b-form-group>
                <ValidationProvider name="value" rules="required" v-slot="{ errors }">
                    <b-form-input name="value" placeholder="Value" 
                        v-model="header.value"
                        :class="(errors.length > 0 ? ' is-invalid' : '')"></b-form-input>
                    <div class="invalid-feedback">
                        <span>{{ errors[0] }}</span>
                    </div>
                </ValidationProvider>
            </b-form-group>
        </b-col>
        <b-col lg="1" md="auto">
            <button type="button" @click="removeHeader(headerCounter)" data-action-type="remove" class="btn btn-default text-danger" >
                <i class="fa fa-trash"></i>
            </button> 
        </b-col>
    </b-row>
</template>

<script>
    export default {
        name:'Header',
        props: ['headerCounter','header'],
        methods: {
            removeHeader(headerCounter) {
                this.$emit('removeHeader', headerCounter)
            }
        }
    }
</script>