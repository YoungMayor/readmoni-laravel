var FAQADMIN = new Vue({
    el: "#faq-admin-app",

    data: {
        faqs: {
            'faq_new': {
                key: 'new',
                faq_id: 'faq_new',
                question: 'New Question',
                answer: 'Answer to Question',
                author: 'System Generated',
                mail: 'systemgenerated',
                isEditting: false,
                isSaving: false
            }
        },
        getURL: "",
        saveURL: "",
        deleteURL: "",
    },

    computed: {
        faq_id: function() {
            //
        }
    },

    methods: {
        toogleEdit(key) {
            this.faqs[key]['isEditting'] = this.faqs[key]['isEditting'] == true ? false : true;
        },

        saveQuestion(key) {
            var bar = this;
            var faq = this.faqs[key];

            faq.isSaving = true;
            faq.saveError = [];
            axios.post(bar.saveURL, {
                question: faq.question,
                answer: faq.answer,
                key: faq.key
            }).then(function(response) {
                var data = response.data;

                if (data.details) {
                    bar.parseAndSave(data.details);
                }

                if (data.error) {
                    faq.saveError = data.error
                }
            }).catch(function(error) {

            }).then(function() {
                faq.isSaving = false
            });
        },

        deleteQuestion(key) {
            alert('FAQ Deleting is currently disabled, just modify and leave the answer empty to hide from users.');
        },

        getQuestions() {
            var bar = this;
            axios.get(bar.getURL).then(function(response) {
                var data = response.data;

                for (const key in data) {
                    thisFaq = data[key];

                    bar.parseAndSave(thisFaq);
                }
            }).catch(function(error) {

            }).then(function() {

            });
        },

        parseAndSave(faq) {
            var bar = this;

            bar.$set(bar.faqs, 'faq_' + faq.id, {
                'key': faq.id,
                'faq_id': 'faq_' + faq.id,
                'question': faq.question,
                'answer': faq.answer,
                'author': faq.name,
                'mail': faq.email,
                'isEditting': false,
                'isSaving': false,
                'saveError': []
            });
        }
    },

    mounted: function() {
        this.getURL = $(this.$el).attr('data-getURL');
        this.saveURL = $(this.$el).attr('data-saveURL');
        this.deleteURL = $(this.$el).attr('data-deleteURL');

        this.getQuestions();
    },

    created: function() {}
});