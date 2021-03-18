<template>
    <form @submit.prevent="updateComment">
        <div id="modal1" class="modal modal-fixed-footer" ref="updateComment">
            <div class="modal-content">
                <h5>Данные комментрария</h5>
                <hr>
                <div class="panel">
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">face</i>
                            <label for="name">Имя Автора</label>
                            <input name="first-name" type="text"
                                   placeholder="Введите Имя.."
                                   class="input-text"
                                   id="name" required=""
                                   v-model="comment.name"
                            >
                            <!--<span class="helper-text invalid"
                                  v-if="getErrorsEditProduct.name"
                            >
                                {{ getErrorsEditProduct.name[0] }}
                            </span>-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">mode_edit</i>
                            <textarea id="textarea2"
                                      class="materialize-textarea"
                                      data-length="120"
                                      v-model="comment.text"
                            ></textarea>
                            <label for="textarea2">Текст Комментария</label>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="switch">
                            <label>
                                <!--  <i class="material-icons left">visibility_off</i>--> Нет
                                <input type="checkbox" v-model="comment.status">
                                <span class="lever"></span>
                                <!--  <i class="material-icons ">visibility</i>--> Опубликовано
                            </label>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <a href="" @click.prevent="" class="modal-close btn-flat pink darken-1 white-text">
                    <i class="material-icons right">close</i>Закрыть
                </a>
                <button class="btn waves-effect waves-light deep-purple darken-4" type="submit">
                    <i class="material-icons right">send</i> Выполнено
                </button>
            </div>

        </div>
    </form>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "ModalCommentEdit",
    props: {
        comment_data: {}
    },
    data() {
        return {
            modalInstanceComment: null,
        }
    },
    computed: {
        comment() {
            //преобразов false
            this.comment_data['status'] = !!Number(this.comment_data.status)
            return  this.comment_data
        }
    },
    methods: {
        ...mapActions([
            'acceptComment',

        ]),
        updateComment() {
            let status = this.comment_data.status ? '1' : '0'
            let formData = new FormData();

            formData.append('id', this.comment_data.id)
            formData.append('name', this.comment_data.name)
            formData.append('text', this.comment_data.text)
            formData.append('status', status)
            formData.append('_method', "PUT")
            this.acceptComment(formData).then((resp) => {
                if (resp.status === 200){
                    this.modalInstanceComment.close()
                    this.$toasted.show('Комментарий отредактирован!',{
                        type: 'success',
                    })
                }
            })

        }
    },
    mounted() {
        this.modalInstanceComment = M.Modal.init(this.$refs.updateComment);;

        setTimeout(()=>{
            window.M.updateTextFields()
        },200)
    }
}
</script>

<style scoped>

</style>
