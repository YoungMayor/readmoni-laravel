var REQUESTS = new Vue({
    el: "#payouts_form",
    data: {
        requests: [],
        bar: this,
        showSubmitContainer: '',
        selectedUsersCount: 'None',
        grandCost: '0',
        selectedFields: [],
        loadingClass: 'fa fa-spin fa-spinner',
        dollarClass: 'fas fa-dollar-sign',
        loadingBTNIcon: 'fas fa-dollar-sign',
        submitBTNDisabled: false,

        loadPayoutsBTN: $("#load-payouts"),
        loadingPayouts: false,
        payouts_page: 0,
    },
    methods: {
        attachEvent() {
            var selected = Number($(".mass_payout:checked").length);

            if (selected >= 1) {
                this.selectedUsersCount = selected;
                this.showSubmitContainer = "show_block";
            } else {
                this.selectedUsersCount = 'None'
                this.showSubmitContainer = "";
            }
            this.calculateCost();
        },
        calculateCost() {
            var bar = this;
            bar.grandCost = 0
            $(".mass_payout:checked").each(function() {
                bar.grandCost += Number($(this).attr("data-amt"));
            });
        },
        saveSelectedFields() {
            var bar = this;
            bar.selectedFields = [];
            $(".mass_payout:checked").each(function() {
                var thisID = $(this).val();
                bar.selectedFields.push(thisID);
            })
        },
        deleteSelectedFields() {
            var bar = this;
            this.requests = this.requests.filter(function(arg) {
                return !bar.selectedFields.includes(String(arg.rid));
            });
            $(".mass_payout:checked").prop('checked', false)
            this.attachEvent();
        },
        submitForm(e) {
            var bar = this;
            var thisForm = $(e.target)[0]
            var thisFormTarget = $(thisForm).attr("action");
            var formData = new FormData(thisForm);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
                }
            });

            $.ajax({
                method: "POST",
                url: thisFormTarget,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function() {
                    bar.saveSelectedFields();
                    bar.loadingBTNIcon = bar.loadingClass;
                    bar.submitBTNDisabled = true;
                },
                complete: function() {
                    bar.loadingBTNIcon = bar.dollarClass;
                    bar.submitBTNDisabled = false;
                },
                error: function() {

                },
                statusCode: {
                    419: function() {
                        location.reload();
                    },
                },
                success: function(response) {
                    if (response.paid) {
                        bar.deleteSelectedFields();
                    }
                },
            });
        },
        getRequests: function() {
            var bar = this;

            var thisBTN = $(bar.loadPayoutsBTN);

            if (bar.loadingPayouts) {
                return false;
            }

            var thisURL = $(thisBTN).attr("data-url");


            bar.loadingPayouts = true;

            axios.post(thisURL, {
                page: bar.payouts_page
            }).then(function(response) {
                var data = response.data;
                if (data.list) {
                    bar.requests = bar.requests.concat(data.list);
                }
                bar.payouts_page = data.next;
            }).catch(function(error) {
                if (error.response.status == '419') {
                    location.reload();
                }
            }).then(function() {
                bar.loadingPayouts = false;
            });
            return;
        }
    }
});