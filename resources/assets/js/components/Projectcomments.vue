<template>
    <div class="container" id="commentApp">
        <div class="row">
            <div class="col-md-4 col-md-offset-8">
                <div class="row" v-for="comment in comments">
                    <div class="col-sm-1">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                        </div>
                    </div>

                    <div class="col-sm-11">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>@{{ comment.user.name }}</strong> <span class="text-muted">commented @{{ comment.timestamp }}</span>
                                <a href="#" class="  pull-right red" @click.prevent="deleteComment(comment)">
                                <span class="glyphicon glyphicon-trash"></span>&nbsp;
                                </a> &nbsp

                                <a href="#" class="pull-right" @click.prevent="editComment(comment)">
                                <span class="glyphicon glyphicon-edit"></span>&nbsp;
                                </a> &nbsp

                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                {{ comment.comment }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //    Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("value");

    export default {
        data: function() {
            return {
                selected: '1',
                optionsProjects: [],
                comments: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
                formErrors:{},
                formErrorsUpdate:{},
                newComment : {'id_project':'','comment':''},
                fillComment : {'id_comment':'','comment':''}
            };
        },

        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            }
        },

        mounted : function(){
            //this.getVuecomments(this.pagination.current_page)
//            console.log(this);
            this.getProjectComments();
        },

        methods : {
//            getVuecomments: function(page){
//                this.$http.get('/vuecomments?page='+page).then((response) => {
//                    this.$set(this,'comments', response.data.data.data);
//                    this.$set(this,'pagination', response.data.pagination);
//                });
//            },
//
//            getComments: function(page){
//                var id_project = 1;
//                this.$http.get('/comments/'+id_project).then((response) => {
//                    this.$set(this,'optionsProjects', response.data.projects);
//                    //this.$set('pagination', response.data.pagination);
//                });
//            },

            getProjectComments: function(comment){
                var id_project = 6;
                this.$http.get('/comments/'+id_project).then((response) => {
                        console.log(response.data.data);
                        this.$set(this, 'comments', response.data.data);
                });
            },
        }
    }
</script>