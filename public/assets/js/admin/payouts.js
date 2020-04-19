function Payouts() {
    var bar = this;

    this.getRequests = function(btn) {
        var thisBTN = $(btn);
        if ($(thisBTN).attr('data-loading') == 'true') {
            return false;
        }
        var thisURL = $(thisBTN).attr("data-url");
        var thisPage = $(thisBTN).attr('data-page');

        var thisTarget = $("#payout_requests");

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $("meta[name='csrf-token']").attr("content")
            }
        });

        $.ajax({
            method: "POST",
            url: thisURL,
            data: {
                page: thisPage
            },
            dataType: "JSON",
            beforeSend: function() {
                bar.loadStart(thisBTN);
            },
            complete: function() {
                bar.loadStop(thisBTN);
            },
            error: function() {
                //             $(thisError).html("There was an error with your request");
            },
            statusCode: {
                419: function() {
                    location.reload();
                },
            },
            success: function(response) {
                if (response.list) {
                    for (var i in response.list) {
                        var thisElem = response.list[i];
                        REQUESTS.requests.push(thisElem);
                    }
                }
                $(thisBTN).attr('data-page', response.next);
            },
        });
    };

    this.loadStart = function(btn) {
        $(btn).append($(loadingICON).clone());
        $(btn).attr('data-loading', 'true');
    }

    this.loadStop = function(btn) {
        $(btn).removeAttr('data-loading');
        $(btn).find('.loading-icon').remove();
    }
}

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
        }
    }
});

let PAYOUTS = new Payouts();

$("#load-requests").on('click', function() {
    PAYOUTS.getRequests(this);
});