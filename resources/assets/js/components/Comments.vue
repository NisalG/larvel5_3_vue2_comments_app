<template>
    <div class="container" id="commentApp">
        <div class="row">
            <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createComment">
                <!--<input type="hidden" name="_token" v-bind:value="csrf_token()">-->
                <div class="form-group">
                    <label for="comment_select">Select a project:</label>

                    <!--<div v-model="myModel">-->
                        <!--<select class="selectpicker" v-model="newComment.id_project"  v-on:change="changeProject()">-->
                            <!--<option v-for="option in optionsProjects" v-bind:value="option.id_project">-->
                                <!--@{{ option.project_name }}-->
                            <!--</option>-->
                        <!--</select>-->
                    <!--</div>-->


                    <!--<select class="selectpicker" v-model="newComment.id_project"  v-on:change="changeProject()">-->
                        <!--<option v-for="option in optionsProjects" v-bind:value="option.id_project">-->
                            <!--{{ option.project_name }}-->
                        <!--</option>-->
                    <!--</select>-->
                    <select v-model="newComment.id_project"  v-on:change="changeProject()">
                        <option v-for="option in optionsProjects" v-bind:value="option.id_project">
                            {{ option.project_name }}
                        </option>
                    </select>

                    <!--<select v-model="selected">-->
                        <!--<option v-for="option in optionsProjects" v-bind:value="option.value">-->
                            <!--{{ option.text }}-->
                        <!--</option>-->
                    <!--</select>-->
                    <!--<span>Selected: {{ selected }}</span>-->

                    <!--<ui-dropdown type="search selection"label="Project" options="selectOptionsProjects" v-model="newItem.id_project"></ui-dropdown>-->
                    <span v-if="formErrors['id_project']" class="error text-danger">@{{ formErrors['id_project'] }}</span>
                </div>
                <div class="form-group">
                    <label for="comment">Add a Comment: <em class="text-light">(up to a 255 characters)</em></label>
                    <!--<textarea class="form-control" rows="5" id="comment" name="comment" maxlength="255" v-on:keyup="countdown" v-model="message" placeholder=""></textarea>-->
                    <textarea name="comment"id="comment-box" class="form-control comment-box" v-model="newComment.comment" maxlength="255"></textarea>
                    <span v-if="formErrors['comment']" class="error text-danger">@{{ formErrors['comment'] }}</span>
                    <!--<p class='text-right text-small' v-bind:class="{'text-danger': hasError }">@{{remainingCount}}</p>-->
                </div>
                <button type="submit" class="btn btn-default pull-right">Submit</button>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h3>Comments</h3>
            </div><!-- /col-sm-12 -->
        </div><!-- /row -->

        <div class="row" v-for="comment in comments">
            <div class="col-sm-1">
                <div class="thumbnail">
                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                </div><!-- /thumbnail -->
            </div><!-- /col-sm-1 -->

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
                        @{{ comment.comment }}
                    </div><!-- /panel-body -->
                </div><!-- /panel panel-default -->
            </div><!-- /col-sm-5 -->
        </div><!-- /row -->

        <!-- Edit Item Modal -->

        <div class="modal fade" id="edit-comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Comment</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateComment(fillComment.id_comment)">
                            <div class="form-group">
                                <label for="title">Comment:</label>
                                <textarea name="comment" class="form-control comment-box" v-model="fillComment.comment" maxlength="255"></textarea>
                                <span v-if="formErrorsUpdate['comment']" class="error text-danger">@{{ formErrorsUpdate['comment'] }}</span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
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
//            console.log('mounted');
            this.getComments();
        },

        methods : {
            getVuecomments: function(page){
                this.$http.get('/vuecomments?page='+page).then((response) => {
                    this.$set(this,'comments', response.data.data.data);
                    this.$set(this,'pagination', response.data.pagination);
                });
            },

            getComments: function(page){
                var id_project = 6;
                this.$http.get('/comments/'+id_project).then((response) => {
                    this.$set(this,'optionsProjects', response.data.projects);
                    //this.$set('pagination', response.data.pagination);
                });
            },

            createComment: function(){
                var input = this.newComment;
                //console.log(input); return;
                this.$http.post('/comments',input).then((response) => {
//                    console.log(response);

                    var input = this.newComment;
//                    console.log(input.id_project);

                    var id_project = input.id_project;
                    this.$http.get('/comments/'+id_project).then((response) => {
                        //console.log(response);
                        this.$set(this,'comments', response.data.data);
                    });

                    //this.newcomment = {'title':'','description':''};
                    this.newComment = {'id_project':'','comment':''};
                    //$("#create-comment").modal('hide');
                    toastr.success('Comment Created Successfully.', 'Success Alert', {timeOut: 5000});
                }, (response) => {
                    console.log('errors');
                    this.formErrors = response.data;
                });
            },

            deleteComment: function(comment){
                //var id_project = 1;
                this.$http.delete('/comments/'+comment.id_comment).then((response) => {
                    //this.changePage(this.pagination.current_page);
                    //this.changePage();
                    var input = this.newComment;
//                    console.log(input.id_project);

                    var id_project = input.id_project;
                    this.$http.get('/comments/'+id_project).then((response) => {
                        //console.log(response);
                        this.$set(this,'comments', response.data.data);
                    });

                    toastr.success('Comment Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                });
            },

            editComment: function(comment){
                //this.fillComment.title = comment.title;

                this.fillComment.id_comment = comment.id_comment;
                this.fillComment.comment = comment.comment;
                //console.log(this.fillComment.comment);return;

                $("#edit-comment").modal('show');
            },

            updateComment: function(id_comment){
                var input = this.fillComment;
                //console.log('sdsadasdsad');

                this.$http.put('/comments/'+id_comment,input).then((response) => {
                    var input = this.newComment;
//                    console.log(input.id_project);

                    var id_project = input.id_project;
                    this.$http.get('/comments/'+id_project).then((response) => {
                        //console.log(response);

                        this.$set(this,'comments', response.data.data);
                    });
                    this.fillComment = {'id_comment':'','comment':''};
                    $("#edit-comment").modal('hide');
                    toastr.success('Comment Updated Successfully.', 'Success Alert', {timeOut: 5000});
                }, (response) => {
                    this.formErrorsUpdate = response.data;
                });
            },

            changeProject: function(comment){
                var input = this.newComment;
//                console.log(input.id_project);

                var id_project = input.id_project;
                this.$http.get('/comments/'+id_project).then((response) => {
//                    console.log(response.data.data);
                    this.$set(this, 'comments', response.data.data);
                });
            },

            changePage: function (page) {
                //this.pagination.current_page = page;
                //this.getVuecomments(page);
                this.getComments();
            }
        }
    }
</script>