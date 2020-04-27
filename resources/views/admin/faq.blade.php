@extends('layouts.user')

@section("title", "ReadMONI")

@section("page-css")

@endsection

@section("page-js")
@js(admin/faq)
@endsection

@section("page-body")

<h2 class="text-center">Frequently Asked Questions</h2>
<p>
    Questions. Click to expand
</p>

<div id="faq-admin-app" data-getURL="{{ route('admin.faq.get.process') }}" data-saveURL="{{ route('admin.faq.save.process') }}" data-deleteURL="">
    <div class="mb-3" v-for="faq in faqs">
        <div class="shadow card">
            <a class="btn btn-link text-left card-header font-weight-bold" data-toggle="collapse" aria-expanded="false" :aria-controls="faq.faq_id" :href="'#'+faq.faq_id" role="button">
                @{{ faq.question }}
            </a>
            <div class="collapse" :id="faq.faq_id">
                <div class="card-body">
                    <form class="m-0" v-if="faq.isEditting" @submit.prevent="saveQuestion(faq.faq_id)">
                        <div class="form-group">
                            <textarea class="form-control" name="question" placeholder="Question here" rows="5" required="" v-model="faq.question"></textarea>
                            
                            <div class="text-danger small" v-for="error in faq.saveError.question">
                                @{{ error }}
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="answer" placeholder="Answer here" rows="5" v-model="faq.answer"></textarea>
                            
                            <div class="text-danger small" v-for="error in faq.saveError.answer">
                                @{{ error }}
                            </div>
                        </div>


                        <div class="form-group text-right">
                            <button class="btn btn-success btn-icon-split" type="submit">
                                <template v-if="!faq.isSaving">
                                    <span class="text-white-50 icon">
                                        <i class="far fa-save"></i>
                                    </span>
                                    <span class="text-white text">
                                        Save Question
                                    </span>
                                </template>
                                <template v-else>
                                    <span class="text-white-50 icon">
                                        <i class="fa fa-spin fa-spinner"></i>
                                    </span>
                                    <span class="text-white text">
                                        Saving...
                                    </span>
                                </template>
                            </button>
                        </div>
                    </form>

                    <p class="m-0" v-else>
                        @{{ faq.answer }}
                    </p>
                </div>

                <div class="text-center text-white bg-dark p-2">
                    <span class="small">
                        Question asked by: 
                        <strong>
                            @{{ faq.author }}
                        </strong>
                        <a href="mail:youngmar08@gmail.com">
                            <em>
                                @{{ faq.mail }}
                            </em>
                        </a>
                    </span>
                </div>

                <div class="text-center p-2">
                    <div class="btn-group" role="group">
                        <button class="btn btn-outline-info" type="button" @click="toogleEdit(faq.faq_id)">
                            <i class="far fa-edit"></i>
                            <span class="pl-2" v-if="!faq.isEditting">
                                Edit FAQ
                            </span>
                            <span v-else>
                                Close Edittor
                            </span>
                        </button>
                        <button class="btn btn-danger" type="button" @click="deleteQuestion(faq.faq_id)">
                            <span class="pr-2">
                                Delete FAQ
                            </span>
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection