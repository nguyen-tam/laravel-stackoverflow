<template>
    <div>        
        <div class="row question-info">
            <div class="col-lg-2">
                <p class="text-grey" v-on:click="voteQuestion(question.id, constants.vote_type.UP_VOTE)">
                    <i v-bind:class="{voted:question.up_voted}" class="fa fa-sort-asc fa-3x"></i>
                </p>
                <h3 class="text-grey">{{ question.votes }}</h3>
                <p class="text-grey" v-on:click="voteQuestion(question.id, constants.vote_type.DOWN_VOTE)">
                    <i v-bind:class="{voted:question.down_voted}" class="fa fa-sort-desc fa-3x"></i>
                </p>            
            </div>
            <div class="col-lg-10">            
                <div>{{ question.content }}</div>
                <br/>
                <div class="tag-list">
                    <a :href="'/tag/' + tag" class="item" v-for="tag in question.tags">
                        {{tag}}
                    </a>
                </div>
                <div class="question-author-info pull-right">
                    <p>asked {{ question.created_at }}</p>
                    <img width="60px" height="60px" v-bind:src="question.asked_user_avatar"/>
                    <a :href="'/user/' + question.asked_user_id">&nbsp; {{ question.asked_user }}</a>
                </div>
            </div>            
        </div>
        <!-- /.question-info -->

        <div class="row answers-count">
            <div class="col-lg-12">
                <h3>{{ answers.length }} answers</h3>
            </div>
        </div>
        <!-- /.answers-count -->
        <div class="row">
            <div class="col-lg-12 answers-info">

                <div v-for="(answer, index) in answers">

                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-6">
                            <p class="text-grey" v-on:click="voteAnswer(answer.id, constants.vote_type.UP_VOTE, index)">
                                <i v-bind:class="{voted:answer.up_voted}" class="fa fa-sort-asc fa-3x"></i>
                            </p>
                            <h3 class="text-grey">{{ answer.votes }}</h3>
                            <p class="text-grey" v-on:click="voteAnswer(answer.id, constants.vote_type.DOWN_VOTE, index)">
                                <i v-bind:class="{voted:answer.down_voted}" class="fa fa-sort-desc fa-3x"></i>
                            </p>            
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-6">            
                            <div v-html="answer.content"></div>
                                                 
                        </div>
                    </div>
                    <!-- /.col-lg-10 (answers) -->

                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-8 col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 answer-author-info">
                            <p>answered {{ answer.created_at }}</p>
                            <img width="60px" height="60px" v-bind:src="'/uploads/avatars/' + answer.user.avatar"/>
                            <a :href="'/user/' + answer.user.id">&nbsp; {{ answer.user.name }}</a>
                        </div>
                    </div>   

                    <div class="row comments" v-for="comment in answer.children">
                        <div class="col-lg-offset-2 col-lg-10">
                            <p>{{ comment.content }} 
                                - <a :href="'/user/' + comment.user.id" class="commented-by" >&nbsp; {{ comment.user.name }}</a>
                                <span class="commented-at">{{ comment.created_at }}</span></p>
                        </div>
                    </div>
                    <!-- /.comments -->
                    <div class="row">
                        <div class="col-lg-offset-2 col-lg-10 add-a-comment">
                            
                            <p v-show="!answer.showAddComment && isAuthenticated" v-on:click="showComment(answer)">add a comment</p>

                            <div v-show="answer.showAddComment">
                                <br/>
                                <textarea v-model="answer.new_comment" style="width:100%"></textarea>
                                <a v-on:click="doneComment(answer)">Add Comment</a>
                            </div>
                        </div>
                    </div>                    
                    <!-- / add a comment -->

                    <br/>
                </div>

            </div>
            <!-- /.answers-info -->
        </div>
    </div>
</template>

<style type="text/css">
    .voted {
        color: #f48024;
    }
</style>
<script>
    export default {

        data() {
            return {
                question: [],
                answers: [],
                isActive: 'red',
                constants: [],
                isAuthenticated:false
            };
        },
        created() {
            this.fetchQuestionData();
            this.fetchAnswers();
            this.fetchConstants();
            this.checkAuthenticated();
        },
        methods: {

            fetchConstants() {
                axios.get('/api/get_constant/').then((res) => {
                    this.constants = res.data;
                });
            },
            checkAuthenticated() {
                axios.get('/user/isAuthenticated/').then((res) => {
                    this.isAuthenticated = res.data;
                });
            },
            fetchQuestionData() {
                axios.get('/question/' + this.question_id).then((res) => {
                    this.question = res.data;
                    this.question.created_at = moment(this.question.created_at).format('DD-MM-YY hh:mm');
                });
            },
            fetchAnswers() {
                axios.get('/answers/' + this.question_id)
                .then((res) => {
                    
                    res.data.map(function(value, key) {
                        value.showAddComment = false;
                        value.created_at = moment(value.created_at).format('DD-MM-YY hh:mm');
                    });

                    this.answers = res.data;
                    
                });
            },
            resetUpVoteDownVote() {
                this.question.down_voted = false;
                this.question.up_voted = false;
            },
            showComment : function(answer) {
                answer.showAddComment = true;
            },
            doneComment: function(answer) {
                
                axios.post('/questions/comment', {
                    answer_id : answer.id,
                    content: answer.new_comment
                })
                .then((res) => {
                    if (res.data.status) {
                        this.fetchAnswers();
                    }
                })

            },
            voteQuestion: function (vote_id, vote_type) {

                axios.post('/vote_action', {
                    vote_id : vote_id,
                    vote_type: vote_type,
                    vote_category: this.constants.vote_category.QUESTION
                })
                .then((res) => {
                    if (res.data.status) {

                        this.question.votes = res.data.votes;
                        this.question.up_voted = res.data.up_voted;
                        this.question.down_voted = res.data.down_voted;                                                
                    }
                })
                .catch((err) => {
                    if (err.response.status == 401) {
                        alert("You must login before using this function");
                    }
                });
            },
            voteAnswer: function (vote_id, vote_type, index) {

                axios.post('/vote_action', {
                    vote_id : vote_id,
                    vote_type: vote_type,
                    vote_category: this.constants.vote_category.ANSWER
                })
                .then((res) => {
                    if (res.data.status) {
                        this.answers[index].votes = res.data.votes;
                        this.answers[index].up_voted = res.data.up_voted;
                        this.answers[index].down_voted = res.data.down_voted;                                                
                    }
                })
                .catch((err) => {
                    if (err.response.status == 401) {
                        alert("You must login before using this function");
                    }
                });
            }
        },
        props: ['question_id']
    }
</script>
