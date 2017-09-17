<template>
    <div>        
        <div class="row question-info">
            <div class="col-lg-2">
                <p v-on:click="voteQuestion(question.id, 'up')"><i class="fa fa-sort-asc fa-3x"></i></p>
                <h3>{{ question.up_vote - question.down_vote }}</h3>
                <p><i class="fa fa-sort-desc fa-3x"></i></p>            
            </div>
            <div class="col-lg-10">            
                <div>{{ question.content }}</div>
                <div class="author-info pull-right">
                    <p>asked {{ question.created_at }}</p>
                    <p>by {{ question.asked_user }}</p>
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

                <div class="row" v-for="answer in answers">

                    <div class="col-lg-2">
                        <p><i class="fa fa-sort-asc fa-3x"></i></p>
                        <h3>{{ answer.up_vote - answer.down_vote }}</h3>
                        <p><i class="fa fa-sort-desc fa-3x"></i></p>            
                    </div>
                    <div class="col-lg-10">            
                        <div>{{ answer.content }}</div>
                        <div class="author-info pull-right">
                            <p>answered {{ answer.created_at }}</p>
                            <p>by {{ answer.user.name }}</p>
                        </div>                        
                    </div>
                    <!-- /.col-lg-10 (answers) -->

                    <div class="row comments" v-for="comment in answer.children">
                        <div class="col-lg-offset-2 col-lg-10">
                            <p>{{ comment.content }} 
                                - <span class="commented-by">{{ comment.user.name }}</span> 
                                <span class="commented-at">{{ comment.created_at }}</span></p>
                        </div>
                    </div>
                    <!-- /.comments -->
                    <div class="row">
                        <div class="col-lg-offset-2 col-lg-10">
                            <p>add a comment</p>
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

<script>
    export default {

        data() {
            return {
                question: [],
                answers: [],
            };
        },
        created() {
            this.fetchQuestionData();
            this.fetchAnswers();
        },
        methods: {
            fetchQuestionData() {
                axios.get('/api/question/' + this.question_id).then((res) => {
                    this.question = res.data;
                });
            },
            fetchAnswers() {
                axios.get('/api/answers/' + this.question_id)
                .then((res) => {
                    this.answers = res.data;
                });
            },
            voteQuestion: function (question_id, type) {
                // alert(id);
                axios.post('/api/vote_question', {
                    question_id : question_id,
                    type: type
                })
                .then((res) => {
                    this.answers = res.data;
                });
            }
        },
        props: ['question_id']
    }
</script>
