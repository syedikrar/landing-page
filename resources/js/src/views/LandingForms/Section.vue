<template>
    <div class="accordion career-style faq-style iq-accordion mt-4" role="tablist" 
        style="background-color: #efeefd; padding: 15px; border-radius: 20px; cursor:move">
        <div class=" d-flex mb-2">
            <h4>{{section.title}}</h4>
            <span class="ml-auto ">
                <button type="button"  class="btn btn-default text-primary px-0"
                    @click="showModal('create',sectionCounter)">
                    <i class="fas fa-plus-circle"></i>
                </button>   
                <button type="button"  class="btn btn-default text-success px-0 " 
                @click="showModal('update_section',sectionCounter)">
                    <i class="fa fa-pen" />
                </button>  
                <button type="button"  data-action-type="remove" class="btn btn-default text-danger px-0 "
                @click="removeSection(sectionCounter)" >
                    <i class="fa fa-trash"></i>
                </button>
            
            </span>
        </div>       
        <draggable  :list="section.fields" 
            class="list-group" ghost-class="ghost"  v-bind="dragOptions"
            :animation="200" group="fields">
            <component
                v-for="(field, index) in section.fields" @removeField="removeField" 
                :key="index"
                :counter="index"
                :is="field.component"
                :field="field"
                :sectionCounter="sectionCounter"
            />
        </draggable>
    </div>

</template>
<script>
    import draggable from 'vuedraggable'
    export default {
        name:'Section',
        props: ['sectionCounter','section'],
        components:{draggable:draggable},
        methods: {
            removeSection(sectionCounter) {
                this.$emit('removeSection', sectionCounter)
            },
            removeField(sectionCounter,counter) {
                this.$emit('removeField', sectionCounter, counter)
            },
            showModal(type, sectionCounter) {
                this.$emit('showModal',type, sectionCounter)
            },
            
        },
        computed: {
            dragOptions() {
                return {
                    animation: 200,
                    group: "description",
                    disabled: false,
                    ghostClass: "ghost"
                };
            }
        }
    }
</script>

<style scoped>
.iq-accordion.career-style.faq-style .iq-accordion-block {
    padding: 4px 7px!important;
}
</style>
