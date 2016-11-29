@extends('master')

@section('content')
    {{------------------------------------------------------------------------------------------------------------------------}}
    {{--<div class="container" id="commentApp">--}}

        {{--<div class="row">--}}



            {{--<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createComment">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="comment">Select a project:</label>--}}

                    {{--<div v-model="myModel">--}}

                        {{--<select class="selectpicker" v-model="newComment.id_project"  v-on:change="changeProject()">--}}
                            {{--<option v-for="option in optionsProjects" v-bind:value="option.id_project">--}}
                                {{--@{{ option.project_name }}--}}
                            {{--</option>--}}
                        {{--</select>--}}
                    {{--</div>--}}
                    {{--<ui-dropdown type="search selection"label="Project" options="selectOptionsProjects" v-model="newItem.id_project"></ui-dropdown>--}}
                    {{--<span v-if="formErrors['id_project']" class="error text-danger">@{{ formErrors['id_project'] }}</span>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="comment">Add a Comment: <em class="text-light">(up to a 255 characters)</em></label>--}}
                    {{--<textarea class="form-control" rows="5" id="comment" name="comment" maxlength="255" v-on:keyup="countdown" v-model="message" placeholder=""></textarea>--}}
                    {{--<textarea name="comment"id="comment-box" class="form-control comment-box" v-model="newComment.comment" maxlength="255"></textarea>--}}
                    {{--<span v-if="formErrors['comment']" class="error text-danger">@{{ formErrors['comment'] }}</span>--}}
                    {{--<p class='text-right text-small' v-bind:class="{'text-danger': hasError }">@{{remainingCount}}</p>--}}
                {{--</div>--}}
                {{--<button type="submit" class="btn btn-default pull-right">Submit</button>--}}
            {{--</form>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                {{--<h3>Comments</h3>--}}
            {{--</div><!-- /col-sm-12 -->--}}
        {{--</div><!-- /row -->--}}


        {{--<div class="row" v-for="comment in comments">--}}
            {{--<div class="col-sm-1">--}}
                {{--<div class="thumbnail">--}}
                    {{--<img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">--}}
                {{--</div><!-- /thumbnail -->--}}
            {{--</div><!-- /col-sm-1 -->--}}

            {{--<div class="col-sm-11">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<strong>@{{ comment.user.name }}</strong> <span class="text-muted">commented @{{ comment.timestamp }}</span>--}}
                        {{--<a href="#" class="  pull-right red" @click.prevent="deleteComment(comment)">--}}
                            {{--<span class="glyphicon glyphicon-trash"></span>&nbsp;--}}
                        {{--</a> &nbsp--}}

                        {{--<a href="#" class="pull-right" @click.prevent="editComment(comment)">--}}
                            {{--<span class="glyphicon glyphicon-edit"></span>&nbsp;--}}
                        {{--</a> &nbsp--}}

                        {{--<div class="clearfix"></div>--}}
                    {{--</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--@{{ comment.comment }}--}}
                    {{--</div><!-- /panel-body -->--}}
                {{--</div><!-- /panel panel-default -->--}}
            {{--</div><!-- /col-sm-5 -->--}}
        {{--</div><!-- /row -->--}}

        {{--<tasks></tasks>--}}



        {{--<!-- Edit Item Modal -->--}}

        {{--<div class="modal fade" id="edit-comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}

            {{--<div class="modal-dialog" role="document">--}}

                {{--<div class="modal-content">--}}

                    {{--<div class="modal-header">--}}

                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}

                        {{--<h4 class="modal-title" id="myModalLabel">Edit Comment</h4>--}}

                    {{--</div>--}}

                    {{--<div class="modal-body">--}}


                        {{--<form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateComment(fillComment.id_comment)">--}}

                            {{--<div class="form-group">--}}

                                {{--<label for="title">Comment:</label>--}}

                                {{--<textarea name="comment" class="form-control comment-box" v-model="fillComment.comment" maxlength="255"></textarea>--}}

                                {{--<span v-if="formErrorsUpdate['comment']" class="error text-danger">@{{ formErrorsUpdate['comment'] }}</span>--}}

                            {{--</div>--}}


                            {{--<div class="form-group">--}}

                                {{--<button type="submit" class="btn btn-success">Submit</button>--}}

                            {{--</div>--}}


                        {{--</form>--}}


                    {{--</div>--}}

                {{--</div>--}}

            {{--</div>--}}

        {{--</div>--}}

    {{--</div><!-- /container -->--}}

    <comments></comments>
@endsection

@section('footer')
    {{--<script type="text/javascript" src="/js/comments.js"></script>--}}
@endsection
